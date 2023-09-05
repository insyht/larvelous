<?php

namespace Insyht\Larvelous\Forms\Components;


use Insyht\Larvelous\Models\BlockVariableValue;

interface BlockFieldInterface
{
    public function setExtraData(BlockVariableValue $data): static;

    /** This function is used to modify a BlockVariableValue's value if needed */
    public function modify($value);
}
