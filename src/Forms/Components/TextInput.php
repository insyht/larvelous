<?php

namespace Insyht\Larvelous\Forms\Components;

use Insyht\Larvelous\Models\BlockVariableValue;

class TextInput extends \Filament\Forms\Components\TextInput implements BlockFieldInterface
{
    public function setExtraData(BlockVariableValue $data): static
    {
        return $this;
    }

    public function modify($value)
    {
        return $value;
    }

    public function save(BlockVariableValue $data): BlockVariableValue
    {
        // Do nothing
        return $data;
    }
}
