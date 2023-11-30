<?php

namespace Insyht\Larvelous\Search\Interfaces;

interface SearchInterface
{
    public function addSearchable(SearchableInterface $searchable): void;
    /** @var SearchableInterface[] */
    public function getSearchables(): array;
}
