<?php

namespace Insyht\Larvelous\Filament\Resources\TemplateResource\Pages;

use Insyht\Larvelous\Filament\Resources\TemplateResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTemplate extends CreateRecord
{
    protected static string $resource = TemplateResource::class;

    public function mount() : void
    {
        parent::mount();
        abort_unless(auth()->user()->hasRole('admin'), 403);
    }
}
