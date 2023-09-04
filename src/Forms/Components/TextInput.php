<?php

namespace App\Forms\Components;

use App\Models\BlockVariableValue;

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
}
