<?php

namespace Insyht\Larvelous\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function slides()
    {
        return $this->hasMany(Slide::class)->orderBy('ordering');
    }

    public function getId(): int
    {
        return $this->id;
    }
}
