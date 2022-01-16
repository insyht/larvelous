<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    public function blockVariables()
    {
        return $this->hasMany(BlockVariable::class);
    }

    public function blockTemplates()
    {
        return $this->belongsToMany(BlockTemplate::class);
    }

    public function templates()
    {
        return $this->belongsToMany(Template::class)->using(BlockTemplate::class);
    }
}
