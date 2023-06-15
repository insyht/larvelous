<?php

namespace App\Forms\Components;

use App\Custom\PageBlockValue;
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

    public function getPreview(): ?string
    {
        return $this->evaluate(Storage::url($this->value));
    }

    public function setExtraData(PageBlockValue $data): static
    {
        $this->preserveFilenames()->image()->directory('images');
        $this->value($data->value);

        return $this;
    }

    public function modify($value)
    {
        return Storage::url($value);
    }
}
