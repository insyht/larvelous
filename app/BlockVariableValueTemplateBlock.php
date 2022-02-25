<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockVariableValueTemplateBlock extends Model
{
    use HasFactory;

    public function blockVariableValue()
    {
        // todo Fetch de juiste language_id ergens vandaan, is hier nog hardcoded op 3
        return $this->belongsTo(BlockVariableValue::class)->where('language_id', 3);
    }

    public function templateBlock()
    {
        return $this->belongsTo(BlockTemplate::class);
    }
}
