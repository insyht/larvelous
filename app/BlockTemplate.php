<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BlockTemplate extends Pivot
{
    use HasFactory;

    public $incrementing = true;

    public function block()
    {
        return $this->belongsToMany(Block::class);
    }

    public function template()
    {
        return $this->belongsToMany(Template::class);
    }

    public function blockVariableValueTemplateBlocks()
    {
        return $this->hasMany(BlockVariableValueTemplateBlock::class);
    }
}
