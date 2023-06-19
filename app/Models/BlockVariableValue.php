<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockVariableValue extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['block_variable_id', 'language_id', 'page_id', 'block_template_id', 'value'];

    protected static function booted()
    {
        static::saving(function (self $blockVariableValue) {
            /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\BlockVariableOption[] $options */
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
}
