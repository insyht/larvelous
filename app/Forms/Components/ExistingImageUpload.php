<?php

namespace App\Forms\Components;

use Closure;
use Filament\Forms\Components\FileUpload;

class ExistingImageUpload extends FileUpload
{
    protected string $view = 'forms.components.existing-image-upload';

    protected string | Closure | null $value = '';


    public function value(string | Closure | null $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->evaluate($this->value);
    }
}
