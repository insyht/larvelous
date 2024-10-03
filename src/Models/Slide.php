<?php

namespace Insyht\Larvelous\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['image', 'text', 'ordering'];

    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }

    public function getId(): int
    {
        return $this->id;
    }
}
