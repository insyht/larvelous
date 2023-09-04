<?php

namespace App\Forms\Components;

use App\Models\BlockVariableValue;
use Closure;
use Filament\Forms\Components\FileUpload;
use Storage;

class ExistingImageUpload extends FileUpload implements BlockFieldInterface
{
    protected string | Closure | null $value = '';
    protected string | null $preview = '';


    public function value(string | Closure | null $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->evaluate($this->value);
    }

    public function setExtraData(BlockVariableValue $data): static
    {
        $this->preserveFilenames()->image()->directory('images');
        $this->value($data->value);

        return $this;
    }

    public function modify($value)
    {
        if (str_contains(url()->full(), 'livewire')) {
            // Livewire cannot handle the correct url, it wants the url without the Storage prepended to it

            return $value;
        }

        return Storage::url($value);
    }
}
