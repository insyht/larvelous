<?php

namespace Insyht\Larvelous\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockVariable extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function blockVariableValues()
    {
        return $this->hasMany(BlockVariableValue::class);
    }

    public function blockVariableOptions()
    {
        return $this->hasMany(BlockVariableOption::class);
    }

    public function variableType()
    {
        return $this->belongsTo(BlockVariableType::class, 'type', 'name');
    }
}
