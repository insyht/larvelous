<?php

namespace Insyht\Larvelous\Collections;

use Illuminate\Database\Eloquent\Collection;
use Insyht\Larvelous\Models\MenuItem;

class MenuItemCollection extends Collection
{
    public function push(...$values)
    {
        foreach ($values as $value) {
            if ($value instanceof MenuItem) {
                $this->items[] = $value;
            }
        }
    }

    public function put($key, $value)
    {
        if (!$value instanceof MenuItem) {
            return $this;
        }

        return parent::put($key, $value);
    }

    public function prepend($value, $key = null)
    {
        if (!$value instanceof MenuItem) {
            return $this;
        }

        return parent::prepend($value, $key);
    }

    public function add($item)
    {
        if (!$item instanceof MenuItem) {
            return $this;
        }

        return parent::add($item);
    }
}
