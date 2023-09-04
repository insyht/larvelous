<?php

namespace App\Filament\Resources\TemplateResource\Pages;

use App\Filament\Resources\TemplateResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTemplate extends CreateRecord
{
    protected static string $resource = TemplateResource::class;

    public function mount() : void
    {
        parent::mount();
        abort_unless(auth()->user()->hasRole('Admin'), 403);
    }
}
