<?php

namespace Insyht\Larvelous\Filament\Resources\TemplateResource\Pages;

use Insyht\Larvelous\Filament\Resources\TemplateResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTemplate extends EditRecord
{
    protected static string $resource = TemplateResource::class;

    public function mount($record) : void
    {
        parent::mount($record);
        abort_unless(auth()->user()->hasRole('admin'), 403);
    }

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
