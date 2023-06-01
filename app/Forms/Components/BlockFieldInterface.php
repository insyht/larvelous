<?php

namespace App\Forms\Components;

use App\Custom\PageBlockValue;

interface BlockFieldInterface
{
    public function setExtraData(PageBlockValue $data): static;
}
