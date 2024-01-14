<?php

namespace Insyht\Larvelous\Search\Collections;

use Illuminate\Support\Collection;
use Insyht\Larvelous\Search\Interfaces\SearchResultInterface;

class SearchResultCollection extends Collection
{
    public function push(...$values)
    {
        $values = array_filter($values, function ($value) {
            return $value instanceof SearchResultInterface;
        });

        return parent::push($values);
    }

    public function put($key, $value)
    {
        if (!$value instanceof SearchResultInterface) {
            return $this;
        }

        return parent::put($key, $value);
    }

    public function prepend($value, $key = null)
    {
        if (!$value instanceof SearchResultInterface) {
            return $this;
        }

        return parent::prepend($value, $key);
    }

    public function add($item)
    {
        if (!$item instanceof SearchResultInterface) {
            return $this;
        }

        return parent::add($item);
    }
}
