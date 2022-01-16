<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockVariableValueTemplateBlock extends Model
{
    use HasFactory;

    public function blockVariableValue()
    {
        return $this->belongsTo(BlockVariableValue::class);
    }

    public function templateBlock()
    {
        return $this->belongsTo(BlockTemplate::class);
    }
}
