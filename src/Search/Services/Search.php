<?php

namespace Insyht\Larvelous\Search\Services;

use Insyht\Larvelous\Search\Interfaces\SearchableInterface;
use Insyht\Larvelous\Search\Interfaces\SearchInterface;

class Search implements SearchInterface
{
    protected $searchables = [];

    public function addSearchable(SearchableInterface $searchable): void
    {
        $this->searchables[] = $searchable;
    }

    public function getSearchables(): array
    {
        return $this->searchables;
    }
}
