<?php

namespace Insyht\Larvelous\Filament\Resources\UserResource\Pages;

use Insyht\Larvelous\Filament\Resources\UserResource;
use Closure;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Model;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function mount() : void
    {
        parent::mount();
        abort_unless(auth()->user()->hasRole('Admin'), 403);
    }

    public function isTableRecordSelectable(): ?Closure
    {
        return function (Model $record): bool {
            return $record->name !== 'IWS';
        };
    }
}
