<?php

namespace Insyht\Larvelous\Search\Entities;

use Insyht\Larvelous\Search\Interfaces\SearchQueryInterface;

class SearchQuery implements SearchQueryInterface
{
    public function __construct(protected string $rawQuery = '')
    {
    }

    public function getParamsForLike(): array
    {
        $array = explode(' ', $this->rawQuery);

        array_walk($array, function (&$value) {
            $value = '%' . $value . '%';
        });

        return $array;
    }

    public function fromString(string $searchWord): static
    {
        return new static($searchWord);
    }
}
