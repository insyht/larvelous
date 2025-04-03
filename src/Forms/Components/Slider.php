<?php

namespace Insyht\Larvelous\Forms\Components;

use Closure;
use Filament\Forms\Components\Repeater;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Insyht\Larvelous\Models\BlockVariable;
use Insyht\Larvelous\Models\BlockVariableValue;
use Insyht\Larvelous\Models\Slide;

class Slider extends Repeater implements BlockFieldInterface
{
    protected string|Closure|null $value = '';
    protected string|Closure|null $itemLabel = 'Slide';
    protected string $name = 'slides';
    protected int $blockVariableValueId = 0;
    protected bool|Closure $isReorderableWithButtons = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->cloneable();
    }

    public function setExtraData(BlockVariableValue $data): static
    {
        $this->blockVariableValueId = $data->id;

        return $this;
    }

    public function modify($value)
    {
        $hydratedValues = [];

        if (json_validate($value)) {
            $decodedValue = json_decode($value, true);
            $hydratedValues = [];
            foreach ($decodedValue as $slideId) {
                $slide = Slide::find($slideId);
                if ($slide) {
                    $slide->image = ExistingImageUpload::make('image')->modify($slide->image);
                    $hydratedValues[] = $slide;
                }
            }
        }

        return $hydratedValues;
    }

    public function name(string $name): static
    {
        // The model name/class is a fixed value, we won't allow it to be changed
        return $this;
    }

    public function getModelInstance(): ?Model
    {
        return app(\Insyht\Larvelous\Models\Slide::class);
    }

    public function schema(array|Closure $components): static
    {
        // Set a fixed schema for the slider component
        $this->childComponents(
            [
                'image' => ExistingImageUpload::make('image'),
                'text' => Textarea::make('text'),
            ]
        );

        return $this;
    }

    public function label(string|Htmlable|Closure|null $label): static
    {
        // The model label is a fixed value, we won't allow it to be changed
        $this->label = __('insyht-larvelous::cms.slide');

        return $this;
    }

    public function getState()
    {
        $state = data_get($this->getLivewire(), $this->getStatePath());

        if (is_array($state)) {
            return $state;
        }

        if (blank($state)) {
            return null;
        }

        $decodedState = json_decode($state, true);
        $state = [];
        foreach ($decodedState as $slideId) {
            $state[] = Slide::find($slideId);
        }

        return $state;
    }

    public function save(BlockVariableValue $data): BlockVariableValue
    {
        $usedSlidesIds = [];
        $updatedValue = $data->value;
        foreach ($data->value as $index => $slideData) {
            $slide = new Slide();
            if (!empty($slideData['id'])) {
                $slide = Slide::find($slideData['id']);
            }
            $slide->image = $slideData['image'] ?? '';
            $slide->text = $slideData['text'] ?? '';
            $slide->save();
            $updatedValue[$index] = $slide->id;
            $usedSlidesIds[] = $slide->id;
        }

        $data->value = $updatedValue;
        $data->save();

        // Cleanup on isle three! Remove all slides that are no longer associated with a block variable value
        $slideVariableId = BlockVariable::where('name', 'slide')->first()->id;
        $blockVariableValuesWithSlides = BlockVariableValue::where('block_variable_id', $slideVariableId)->pluck('value')->toArray();
        foreach ($blockVariableValuesWithSlides as $blockVariableValue) {
            $usedSlidesIds = array_merge($usedSlidesIds, json_decode($blockVariableValue, true));
        }
        $usedSlidesIds = array_unique($usedSlidesIds);
        Slide::whereNotIn('id', $usedSlidesIds)->delete();

        return $data;
    }
}
