<?php

namespace Insyht\Larvelous\Filament\Resources\MenuResource\Pages;

use Insyht\Larvelous\Filament\Resources\MenuResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMenu extends EditRecord
{
    protected static string $resource = MenuResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
