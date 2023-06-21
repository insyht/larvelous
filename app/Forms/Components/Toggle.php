<?php

namespace App\Forms\Components;

use App\Models\BlockVariableValue;

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
