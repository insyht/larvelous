<?php

namespace Insyht\Larvelous\Filament\Resources\SettingResource\Pages;

use Filament\Resources\Pages\ManageRecords;
use Insyht\Larvelous\Filament\Resources\SettingResource;

class ManageSettings extends ManageRecords
{
    protected static string $resource = SettingResource::class;

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
