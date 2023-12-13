<?php

namespace Insyht\Larvelous\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface MenuItemInterface
{
    public function getTypeTranslation(): string;
    public function menuItems(): MorphMany;
    public function getUrl(): string;
}
