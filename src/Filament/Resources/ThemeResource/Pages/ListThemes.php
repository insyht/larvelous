<?php

namespace Insyht\Larvelous\Filament\Resources\ThemeResource\Pages;

use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Insyht\Larvelous\Filament\Resources\ThemeResource;
use Insyht\Larvelous\Helpers\PackageHelper;
use Insyht\Larvelous\Models\Theme;
use Throwable;

class ListThemes extends ListRecords
{
    protected static string $resource = ThemeResource::class;
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected function getTitle(): string
    {
        return __('insyht-larvelous::cms.themes');
    }

    protected function getActions(): array
    {
        $actions = [
            Actions\CreateAction::make()->label(__('insyht-larvelous::cms.install_theme')),
        ];

        $updateablePackages = app(PackageHelper::class)->getUpdateablePackageNamesForThemes();
        if (!empty($updateablePackages)) {
            $actions[] = Action::make('update')
                               ->label(__('insyht-larvelous::cms.updateThemes'))
                               ->action('update')
                               ->color('success')
                               ->icon('heroicon-s-refresh');
        }

        return $actions;
    }

    public function activate(Theme $record)
    {
        Theme::all()->each(function (Theme $theme) {
            $theme->active = false;
            $theme->save();
        });
        $record->active = true;
        $record->save();
    }

    public function delete(Theme $record)
    {
        if ($record->id === app('defaultTheme')->id) {
            return;
        }

        if ($record->active) {
            $defaultTheme = app('defaultTheme');
            $defaultTheme->active = true;
            $defaultTheme->save();
        }
        $record->delete();
    }

    public function update()
    {
        Artisan::queue('larvelous:update-themes');
        $success = true;
        try {
            Artisan::call('larvelous:update-themes');
        } catch (Throwable $t) {
            $success = false;
            Log::warning(sprintf('Failed to update themes: %s', $t->getMessage()));
        }
        if ($success) {
            $this->notify('success', __('insyht-larvelous::cms.updateSuccess'));
        } else {
            $this->notify('warning', __('insyht-larvelous::cms.updateFailed'));
        }
    }
}
