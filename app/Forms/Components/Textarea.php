<?php

namespace App\Forms\Components;

use App\Custom\PageBlockValue;

class Textarea extends \Filament\Forms\Components\Textarea implements BlockFieldInterface
{
    public function setExtraData(PageBlockValue $data): static
    {
        return $this;
    }

    public function modify($value)
    {
        return $value;
    }
}
