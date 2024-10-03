<?php

namespace Insyht\Larvelous\Forms\Components;

use Closure;
use Filament\Forms\Components\Repeater;
use Insyht\Larvelous\Models\BlockVariableValue;

class Slide extends Repeater implements BlockFieldInterface
{
    protected string|Closure|null $value = '';

    protected function setUp(): void
    {
        parent::setUp();

        $this->schema([
            'image' => ExistingImageUpload::class,
            'text' => Textarea::class,
        ]);

        $this->cloneable();
        $this->orderable();
        $this->itemLabel('Slide');
    }

    public function setExtraData(BlockVariableValue $data): static
    {
        return $this;
    }

    public function modify($value)
    {
        return $value;
    }
}
