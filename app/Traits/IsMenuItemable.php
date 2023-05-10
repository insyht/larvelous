<?php

namespace App\Traits;

use ReflectionClass;

trait IsMenuItemable
{
    public function getTypeTranslation(): string
    {
        return __('cms.' . strtolower((new ReflectionClass($this))->getShortName()));
    }
}
