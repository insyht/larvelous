<?php

namespace Insyht\Larvelous\Providers;

use Insyht\Larvelous\Filament\Resources\MenuResource;
use Insyht\Larvelous\Filament\Resources\PageResource;
use Insyht\Larvelous\Filament\Resources\TemplateResource;
use Insyht\Larvelous\Filament\Resources\UserResource;

class FilamentServiceProvider extends \Filament\PluginServiceProvider
{
    protected array $resources = [
        MenuResource::class,
        PageResource::class,
        TemplateResource::class,
        UserResource::class,
    ];

    public function configurePackage(Package $package): void
    {
        $package->name('Larvelous');
    }
}
