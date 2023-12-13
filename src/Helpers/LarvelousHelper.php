<?php

namespace Insyht\Larvelous\Helpers;

class LarvelousHelper
{
    public function getMenu(string $position)
    {
        return \Insyht\Larvelous\Models\Menu::where('position', $position)->first();
    }
}
