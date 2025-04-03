<?php

namespace Insyht\Larvelous\Forms\Components;

use Insyht\Larvelous\Models\BlockVariableOption;
use Insyht\Larvelous\Models\BlockVariableValue;

class Dropdown extends \Filament\Forms\Components\Select implements BlockFieldInterface
{
    public function setExtraData(BlockVariableValue $data): static
    {
        $options = BlockVariableOption::all()
                                      ->where('block_variable_id', $data->block_variable_id)
                                      ->pluck('label', 'value')->map(function ($item) {
                                          return __($item);
                                      });
        $this->options($options)->searchable();

        return $this;
    }

    public function modify($value)
    {
        return $value;
    }

    public function save(BlockVariableValue $data): BlockVariableValue
    {
        // Do nothing
        return $data;
    }
}
