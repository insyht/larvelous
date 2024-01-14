<?php

namespace Insyht\Larvelous\Helpers;

use Insyht\Larvelous\Models\Menu;

class LarvelousHelper
{
    public function getMenu(string $position)
    {
        return Menu::where('position', $position)->first();
    }
}
