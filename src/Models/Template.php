<?php

namespace Insyht\Larvelous\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['resource_id', 'label', 'view'];

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function blockTemplates()
    {
        return $this->hasMany(BlockTemplate::class)->orderBy('ordering');
    }

    public function blocks()
    {
        return $this->belongsToMany(Block::class)
                    ->using(BlockTemplate::class)
                    ->orderBy('block_template.ordering')->withPivot(['enabled', 'ordering', 'id']);
    }

    public function enabledBlocks()
    {
        return $this->belongsToMany(Block::class)
                    ->using(BlockTemplate::class)
                    ->where('enabled', 1)
                    ->orderBy('block_template.ordering')->withPivot(['enabled', 'ordering', 'id']);
    }
}
