<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItemType extends Model
{
    public $timestamps = false;
    protected $fillable = ['classname', 'title_column'];

}
