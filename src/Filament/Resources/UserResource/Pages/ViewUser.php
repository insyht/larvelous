<?php

namespace Insyht\Larvelous\Filament\Resources\UserResource\Pages;

use Insyht\Larvelous\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function mount($record) : void
    {
        parent::mount($record);
        abort_unless(auth()->user()->hasRole('admin'), 403);
    }
}
