<?php

namespace Insyht\Larvelous\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockVariableOption extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['block_variable_id', 'label', 'value'];

    public function blockVariable()
    {
        return $this->belongsTo(BlockVariable::class);
    }
}
