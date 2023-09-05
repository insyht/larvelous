<?php

namespace Insyht\Larvelous\Forms\Components;

use Insyht\Larvelous\Models\BlockVariableValue;

class Toggle extends \Filament\Forms\Components\Toggle implements BlockFieldInterface
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
