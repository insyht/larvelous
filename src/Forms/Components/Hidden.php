<?php

namespace Insyht\Larvelous\Forms\Components;

use Insyht\Larvelous\Models\BlockVariableValue;

class Hidden extends \Filament\Forms\Components\Hidden implements BlockFieldInterface
{
    public function setExtraData(BlockVariableValue $data): static
    {
        return $this;
    }

    public function modify($value)
    {
        return $value;
    }
}
