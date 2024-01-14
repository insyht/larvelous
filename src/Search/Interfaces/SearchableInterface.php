<?php

namespace Insyht\Larvelous\Search\Interfaces;

use Insyht\Larvelous\Search\Collections\SearchResultCollection;

interface SearchableInterface
{
    public function search(SearchQueryInterface $query): SearchResultCollection;
}
