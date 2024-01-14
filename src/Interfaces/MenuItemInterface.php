<?php

namespace Insyht\Larvelous\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Insyht\Larvelous\Collections\MenuItemCollection;

interface MenuItemInterface
{
    public function getTypeTranslation(): string;
    public function menuItems(): MorphMany;
    public function getUrl(): string;
    public function getChildren(): MenuItemCollection;
    public function canHaveChildren(): bool;
}
