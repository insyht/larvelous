<?php

namespace Insyht\Larvelous\Filament\Resources\TemplateResource\Pages;

use Insyht\Larvelous\Filament\Resources\TemplateResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTemplate extends ViewRecord
{
    protected static string $resource = TemplateResource::class;

    public function mount($record) : void
    {
        parent::mount($record);
        abort_unless(auth()->user()->hasRole('Admin'), 403);
    }

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
