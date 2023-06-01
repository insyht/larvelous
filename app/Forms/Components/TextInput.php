<?php

namespace App\Forms\Components;

use App\Custom\PageBlockValue;

class TextInput extends \Filament\Forms\Components\TextInput implements BlockFieldInterface
{
    public function setExtraData(PageBlockValue $data): static
    {
        return $this;
    }
}
