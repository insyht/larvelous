<?php

namespace Insyht\Larvelous\Forms\Components;

use Closure;
use Filament\Forms\Components\Repeater;
use Illuminate\Database\Eloquent\Model;
use Insyht\Larvelous\Models\BlockVariableValue;

class Slider extends Repeater implements BlockFieldInterface
{
    protected string|Closure|null $value = '';
    protected string|Closure|null $itemLabel = 'Slide';
    protected string $name = 'Slider';

    protected function setUp(): void
    {
        parent::setUp();
        $this->cloneable();
        $this->orderable('ordering');
        $this->relationship('slides');
    }

    public function setExtraData(BlockVariableValue $data): static
    {
        return $this;
    }

    public function modify($value)
    {
        return $value;
    }

    public function name(string $name): static
    {
        // The model name/class is a fixed value, we won't allow it to be changed
        return $this;
    }

    public function getModelInstance(): ?Model
    {
        return app(\Insyht\Larvelous\Models\Slider::class);
    }

    public function schema(array|Closure $components): static
    {
        $this->childComponents(
            [
                'image' => ExistingImageUpload::class,
                'text' => Textarea::class,
            ]
        );

        return $this;
    }
}
