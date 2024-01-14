<?php

namespace Insyht\Larvelous\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\View\View;
use Insyht\Larvelous\Interfaces\MenuItemInterface;
use Insyht\Larvelous\Search\Collections\SearchResultCollection;
use Insyht\Larvelous\Search\Interfaces\SearchableInterface;
use Insyht\Larvelous\Search\Interfaces\SearchQueryInterface;
use Insyht\Larvelous\Search\Interfaces\SearchResultInterface;
use InvalidArgumentException;
use ReflectionClass;
use Insyht\Larvelous\Collections\MenuItemCollection;

class Page extends Model implements SearchableInterface, MenuItemInterface
{
    public $timestamps = false;

    protected $fillable = ['language_id', 'template_id', 'title', 'url'];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function blocks()
    {
        return $this->template->blocks();
    }

    public function getBlocks()
    {
        return $this->template->blockTemplates;
    }

    public function menuItems(): MorphMany
    {
        return $this->morphMany(MenuItem::class, 'menuitemable');
    }

    protected function url(): Attribute
    {
        // The url of a page may also be an empty string (for the homepage for example), but Laravel will convert that
        // to null. This mutator forces it into a string, even if empty.
        return Attribute::make(
            get: fn (?string $value) => (string) $value,
            set: fn (?string $value) => (string) $value,
        );
    }

    /**
     * Get the template for this page and get all blocks within that template. Then fetch all values for all
     * blocks and save it to those blocks so that the views can show them
     */
    public function setContents(View $view): static
    {
        foreach ($this->template->blockTemplates as $blockTemplate) {
            if ($view->getName() === $blockTemplate->block->getDottedViewPath()) {
                $blockValues = new BlockValues();
                foreach ($blockTemplate->block->blockVariables()->get() as $pageBlockVariable) {
                    $blockValue = $pageBlockVariable->blockVariableValues()
                                                    ->forPageAndBlockTemplate($this, $blockTemplate)
                                                    ->first();
                    if (!$blockValue && !$pageBlockVariable->required) {
                        continue;
                    } elseif (!$blockValue && $pageBlockVariable->required !== 0) {
                        // This block variable is required but does not have a value
                        throw new InvalidArgumentException('This block variable is required but does not have a value');
                    }
                    if (isset($blockValues->{$pageBlockVariable->name})) {
                        if (!is_array($blockValues->{$pageBlockVariable->name})) {
                            $backup = $blockValues->{$pageBlockVariable->name};
                            $blockValues->{$pageBlockVariable->name} = [$backup];
                        }
                        $blockValues->{$pageBlockVariable->name}[] = $blockValue->value;
                    } else {
                        /** @var \Insyht\Larvelous\Models\BlockVariable $pageBlockVariable */
                        $blockValues->{$pageBlockVariable->name} = $blockValue->value;
                    }
                }
                $blockTemplate->addValues($blockValues);
            }
        }

        return $this;
    }

    public function search(SearchQueryInterface $query): SearchResultCollection
    {
        $searchResults = new SearchResultCollection();
        foreach ($query->getParamsForLike() as $like) {
            $foundPages = static::where('title', 'like', $like)->get();
            foreach ($foundPages as $foundPage) {
                $title = $foundPage->title;
                $description = '';
                $url = env('APP_URL') . '/' . $foundPage->url;
                $result = app(SearchResultInterface::class);
                $result->setTitle($title)->setDescription($description)->setUrl($url);
                $searchResults->add($result);
            }
        }

        return $searchResults;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getTypeTranslation(): string
    {
        return __('insyht-larvelous::cms.' . strtolower((new ReflectionClass($this))->getShortName()));
    }

    public function getChildren(): MenuItemCollection
    {
        return new MenuItemCollection();
    }

    public function canHaveChildren(): bool
    {
        return false;
    }
}
