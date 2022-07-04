<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockVariableOption extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function blockVariable()
    {
        return $this->belongsTo(BlockVariable::class);
    }
}
