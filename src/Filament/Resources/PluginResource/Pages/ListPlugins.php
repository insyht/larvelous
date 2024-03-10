<?php

namespace Insyht\Larvelous\Filament\Resources\PluginResource\Pages;

use Artisan;
use Filament\Pages\Actions\Action;
use Illuminate\Support\Facades\Log;
use Insyht\Larvelous\Filament\Resources\PluginResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Insyht\Larvelous\Helpers\PackageHelper;
use Throwable;

class ListPlugins extends ListRecords
{
    protected static string $resource = PluginResource::class;

    protected function getActions(): array
    {
        $actions = [
            Actions\CreateAction::make()->label(__('insyht-larvelous::cms.install')),
        ];

        $updateablePackages = app(PackageHelper::class)->getUpdateablePackageNames();
        if (!empty($updateablePackages)) {
            $actions[] = Action::make('updateSystem')
                               ->label(__('insyht-larvelous::cms.updateSystem'))
                               ->action('updateSystem')
                               ->color('success')
                               ->icon('heroicon-s-refresh');
        }

        return $actions;
    }

    public function updateSystem()
    {
        Artisan::queue('larvelous:update');
        $success = true;
        try {
            Artisan::call('larvelous:update');
        } catch (Throwable $t) {
            $success = false;
            Log::warning(sprintf('Failed to update system: %s', $t->getMessage()));
        }
        if ($success) {
            $this->notify('success', __('insyht-larvelous::cms.updateSuccess'));
        } else {
            $this->notify('warning', __('insyht-larvelous::cms.updateFailed'));
        }
    }
}
