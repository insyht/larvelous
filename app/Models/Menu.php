<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['language_id', 'name', 'position'];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class)->withPivot('ordering');
    }
}
