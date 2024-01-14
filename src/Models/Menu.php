<?php

namespace Insyht\Larvelous\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Insyht\Larvelous\Interfaces\MenuItemInterface;
use ReflectionClass;
use Insyht\Larvelous\Collections\MenuItemCollection;

class Menu extends Model implements MenuItemInterface
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['language_id', 'name', 'position', 'menu_id'];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function items()
    {
        return $this->hasMany(MenuItem::class)->orderBy('ordering');
    }

    public function parent()
    {
        return $this->menu();
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function getTypeTranslation(): string
    {
        return __('insyht-larvelous::cms.' . strtolower((new ReflectionClass($this))->getShortName()));
    }

    public function menuItems(): MorphMany
    {
        return $this->morphMany(MenuItem::class, 'menuitemable');
    }

    public function getUrl(): string
    {
        return '';
    }

    public function getChildren(): MenuItemCollection
    {
        $children = new MenuItemCollection();
        foreach ($this->items as $item) {
            $children->push($item);
        }

        return $children;
    }

    public function canHaveChildren(): bool
    {
        return true;
    }
}
