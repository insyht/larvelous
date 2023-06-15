<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockVariableValue extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected static function booted()
    {
        static::saving(function (self $blockVariableValue) {
            /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\BlockVariableOption[] $options */
            $options = $blockVariableValue->blockVariable->blockVariableOptions;
            if (!$options->isEmpty()) {
                $valueIsAllowed = false;
                foreach ($options as $option) {
                    if ($option->value == $blockVariableValue->value) {
                        $valueIsAllowed = true;
                        break;
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

    public function blockVariableValueTemplateBlocks()
    {
        return $this->hasMany(BlockVariableValueTemplateBlock::class);
    }
    protected function value(): Attribute
    {
        return Attribute::make(
            function ($value) {
                return $this->blockVariable->variableType()->first()->modify($value);
            }
        );
    }
}
