<?php

namespace Insyht\Larvelous\Filament\Resources\MenuResource\Pages;

use Insyht\Larvelous\Filament\Resources\MenuResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMenus extends ListRecords
{
    protected static string $resource = MenuResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
