<?php

namespace Insyht\Larvelous\Forms\Components;

use Insyht\Larvelous\Models\BlockVariableValue;

class Textarea extends \Filament\Forms\Components\Textarea implements BlockFieldInterface
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
