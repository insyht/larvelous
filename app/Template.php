<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function blockTemplates()
    {
        return $this->belongsToMany(BlockTemplate::class);
    }

    public function blocks()
    {
        return $this->belongsToMany(Block::class)->using(BlockTemplate::class);
    }
}
