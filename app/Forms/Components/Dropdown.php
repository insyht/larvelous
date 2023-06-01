<?php

namespace App\Forms\Components;

use App\Custom\PageBlockValue;
use App\Models\BlockVariableOption;

class Dropdown extends \Filament\Forms\Components\Select implements BlockFieldInterface
{
    public function setExtraData(PageBlockValue $data): static
    {
        $options = BlockVariableOption::all()
                                      ->where('block_variable_id', $data->blockVariableId)
                                      ->pluck('label', 'value')->map(function ($item) {
                                          return __($item);
                                      });
        $this->options($options)->searchable();

        return $this;
    }
}
