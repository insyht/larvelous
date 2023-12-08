<?php

namespace Insyht\Larvelous\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class MenuItem extends Model
{
    protected $fillable = ['item_type', 'item_id', 'ordering'];

    public function menuitemable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'item_type', 'item_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

}
