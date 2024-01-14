<?php

namespace Insyht\Larvelous\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Insyht\Larvelous\Collections\MenuItemCollection;

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

    public function isActive(bool $includeChildren = false)
    {
        $currentUrl = url()->current();
        $menuItemUrl = env('APP_URL') . '/' .
                       (substr($this->getUrl(), 0, 1) === '/'
                            ? substr($this->getUrl(), 1)
                            : $this->getUrl());
        // Strip ending slash if it exists
        $menuItemUrl = substr($menuItemUrl, -1, 1) === '/'
                            ? substr($menuItemUrl, 0, -1)
                            : $menuItemUrl;

        $isActive = $currentUrl === $menuItemUrl;
        if ($isActive === false && $includeChildren === true && $this->canHaveChildren()) {
            foreach ($this->getChildren() as $child) {
                if ($child->isActive($includeChildren)) {
                    $isActive = true;
                    break;
                }
            }
        }

        return $isActive;
    }

    public function getUrl(): string
    {
        return $this->menuitemable->getUrl() ?? 'test';
    }

    public function getTitle(): string
    {
        return $this->menuitemable->{$this->getTitleColumn()};
    }

    public function getChildren(): MenuItemCollection
    {
        return $this->menuitemable->getChildren();
    }

    public function canHaveChildren(): bool
    {
        return $this->menuitemable->canHaveChildren();
    }
}
