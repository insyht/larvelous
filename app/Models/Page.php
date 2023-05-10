<?php

namespace App\Models;

use App\Traits\IsMenuItemable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Page extends Model
{
    use HasFactory;
    use IsMenuItemable;

    public $timestamps = false;

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function getBlocks()
    {
        return $this->template->blockTemplates;
    }

    public function menuitems(): MorphMany
    {
        return $this->morphMany(MenuItem::class, 'menuitemable');
    }
}
