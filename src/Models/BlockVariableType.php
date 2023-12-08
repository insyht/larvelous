<?php

namespace Insyht\Larvelous\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockVariableType extends Model
{
    use HasFactory;

    public const TYPE_TEXTFIELD = 'textfield';
    public const TYPE_TEXTAREA = 'textarea';
    public const TYPE_IMAGE = 'image';
    public const TYPE_DROPDOWN = 'dropdown';

    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'name';
    protected $fillable = ['name', 'fqn'];

    public function getId(): int
    {
        return $this->id;
    }

    /** This function is used to modify a BlockVariableValue's value if needed */
    public function modify($value)
    {
        $fqn = $this->fqn;
        return (new $fqn(''))->modify($value);
    }
}
