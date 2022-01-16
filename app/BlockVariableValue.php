<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockVariableValue extends Model
{
    use HasFactory;

    public function blockVariable()
    {
        return $this->belongsTo(BlockVariable::class);
    }

    public function blockVariableValueTemplateBlocks()
    {
        return $this->hasMany(BlockVariableValueTemplateBlock::class);
    }
}
