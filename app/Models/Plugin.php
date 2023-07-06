<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plugin extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['base', 'name', 'path', 'github_url', 'active', 'author'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function scopeActive(Builder $query)
    {
        return $query->where('active', true);
    }
}
