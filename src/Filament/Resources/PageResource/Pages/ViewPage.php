<?php

namespace Insyht\Larvelous\Filament\Resources\PageResource\Pages;

use Insyht\Larvelous\Filament\Resources\PageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPage extends ViewRecord
{
    protected static string $resource = PageResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
