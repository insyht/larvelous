<?php

namespace App\Forms\Components;

use App\Custom\PageBlockValue;

interface BlockFieldInterface
{
    public function setExtraData(PageBlockValue $data): static;

    /** This function is used to modify a BlockVariableValue's value if needed */
    public function modify($value);
}
