<?php

namespace Insyht\Larvelous\Forms\Components;

use Filament\Forms\Components\Repeater;

class Slide extends Repeater
{
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
}
