<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockVariableValue extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::saving(function (self $blockVariableValue) {
            /** @var \Illuminate\Database\Eloquent\Collection|\App\BlockVariableOption[] $options */
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
}
