<?php

namespace Insyht\Larvelous\Models;

use Insyht\Larvelous\Custom\HasManyThroughMultipleTrait;
use Insyht\Larvelous\Traits\IsMenuItemable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\View\View;
use InvalidArgumentException;

class Page extends Model
{
    use HasFactory;
    use IsMenuItemable;
    use HasManyThroughMultipleTrait;

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

    public function menuitems(): MorphMany
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
}
