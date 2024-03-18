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
            Actions\CreateAction::make()->label(__('insyht-larvelous::cms.install_plugin')),
        ];

        $updateablePackages = app(PackageHelper::class)->getUpdateablePackageNamesForPlugins();
        if (!empty($updateablePackages)) {
            $actions[] = Action::make('update')
                               ->label(__('insyht-larvelous::cms.updatePlugins'))
                               ->action('update')
                               ->color('success')
                               ->icon('heroicon-s-refresh');
        }

        return $actions;
    }

    public function update()
    {
        Artisan::queue('larvelous:update-plugins');
        $success = true;
        try {
            Artisan::call('larvelous:update-plugins');
        } catch (Throwable $t) {
            $success = false;
            Log::warning(sprintf('Failed to update plugins: %s', $t->getMessage()));
        }
        if ($success) {
            $this->notify('success', __('insyht-larvelous::cms.updateSuccess'));
        } else {
            $this->notify('warning', __('insyht-larvelous::cms.updateFailed'));
        }
    }
}
