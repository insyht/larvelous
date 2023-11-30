<?php

namespace Insyht\Larvelous\Search\Interfaces;

interface SearchQueryInterface
{
    /** @var string[] */
    public function getParamsForLike(): array;
    public function fromString(string $searchWord): static;
}
