<?php

namespace App\Forms\Components;

use App\Models\BlockVariableValue;

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
