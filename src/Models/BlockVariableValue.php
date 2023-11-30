<?php

namespace Insyht\Larvelous\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Insyht\Larvelous\Search\Collections\SearchResultCollection;
use Insyht\Larvelous\Search\Interfaces\SearchableInterface;
use Insyht\Larvelous\Search\Interfaces\SearchQueryInterface;
use Insyht\Larvelous\Search\Interfaces\SearchResultInterface;

class BlockVariableValue extends Model implements SearchableInterface
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['block_variable_id', 'language_id', 'page_id', 'block_template_id', 'value'];

    protected static function booted()
    {
        static::saving(function (self $blockVariableValue) {
            /** @var \Illuminate\Database\Eloquent\Collection|\Insyht\Larvelous\Models\BlockVariableOption[] $options */
            $options = $blockVariableValue->blockVariable->blockVariableOptions;
            if ($blockVariableValue->value !== '' && !$options->isEmpty()) {
                $valueIsAllowed = false;
                if ($blockVariableValue->value === '') {
                    $valueIsAllowed = true;
                } else {
                    foreach ($options as $option) {
                        if ($option->value == $blockVariableValue->value) {
                            $valueIsAllowed = true;
                            break;
                        }
                    }
                }
            } else {
                $valueIsAllowed = true;
            }

            return $valueIsAllowed;
        });
    }

    public function blockVariable()
    {
        return $this->belongsTo(BlockVariable::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function blockTemplate()
    {
        return $this->belongsTo(BlockTemplate::class);
    }

    protected function value(): Attribute
    {
        return Attribute::make(
            function ($value) {
                return $this->blockVariable->variableType()->first()->modify($value);
            }
        );
    }

    public function scopeForPageAndBlockTemplate(Builder $query, Page $page, BlockTemplate $blockTemplate)
    {
        return $query->where('page_id', $page->id)->where('block_template_id', $blockTemplate->id);
    }


    public function search(SearchQueryInterface $query): SearchResultCollection
    {
        $searchResults = new SearchResultCollection();
        foreach ($query->getParamsForLike() as $like) {
            $foundBlockValues = static::where('value', 'like', $like)->get();
            foreach ($foundBlockValues as $foundBlockValue) {
                $title = $foundBlockValue->page->title;
                $description = $foundBlockValue->value;
                $url = env('APP_URL') . '/' . $foundBlockValue->page->url;
                $result = app(SearchResultInterface::class);
                $result->setTitle($title)->setDescription($description)->setUrl($url);
                $searchResults->add($result);
            }
        }

        return $searchResults;
    }
}
