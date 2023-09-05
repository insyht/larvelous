<?php

namespace Insyht\Larvelous\Filament\Resources\TemplateResource\Pages;

use Insyht\Larvelous\Filament\Resources\TemplateResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTemplates extends ListRecords
{
    protected static string $resource = TemplateResource::class;

    public function mount() : void
    {
        parent::mount();
        abort_unless(auth()->user()->hasRole('Admin'), 403);
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
