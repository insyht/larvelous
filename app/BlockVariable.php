<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockVariable extends Model
{
    use HasFactory;

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function blockVariableValues()
    {
        return $this->hasMany(BlockVariableValue::class);
    }
}
