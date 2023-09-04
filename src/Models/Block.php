<?php

namespace Insyht\Larvelous\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function blockVariables()
    {
        return $this->hasMany(BlockVariable::class)->orderBy('ordering');
    }

    public function templates()
    {
        return $this->belongsToMany(Template::class)->using(BlockTemplate::class)->withPivot(['id', 'ordering']);
    }

    public function getDottedViewPath(): string
    {
        return str_replace('/', '.', $this->view);
    }

    public function getId(): int
    {
        return $this->id;
    }
}
