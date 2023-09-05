<?php

namespace Insyht\Larvelous\Traits;

use ReflectionClass;

trait IsMenuItemable
{
    public function getTypeTranslation(): string
    {
        return __('cms.' . strtolower((new ReflectionClass($this))->getShortName()));
    }
}
