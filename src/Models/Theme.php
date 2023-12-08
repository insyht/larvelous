<?php

namespace Insyht\Larvelous\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'path', 'namespace', 'github_url', 'image', 'active', 'author'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function blocks()
    {
        return $this->belongsToMany(Block::class)->withPivot('template_path');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('active', true);
    }

    public function scopeDefault(Builder $query)
    {
        return $query->where('name', 'Default')->where('namespace', 'Insyht\Larvelous');
    }

    public function getFullPath(bool $appendSlash = true): string
    {
        return base_path() . '/vendor/' . $this->path . ($appendSlash ? '/' : '');
    }
}
