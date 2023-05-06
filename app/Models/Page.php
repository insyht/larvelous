<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function getBlocks()
    {
        return $this->template->blockTemplates;
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class)->withPivot('ordering');
    }

}
