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

    public function getTitleColumn()
    {
        return MenuItemType::where('classname', $this->item_type)->first()?->title_column ?? 'title';
    }

    public function isActive()
    {
        // todo If this item is linked to the page we are on now, return true
        return false;
    }

    public function getUrl(): string
    {
        return $this->menuitemable->getUrl() ?? 'test';
    }
    public function getTitle(): string
    {
        return $this->menuitemable->{$this->getTitleColumn()};
    }
}
