<?php

namespace Insyht\Larvelous\Filament\Resources\ThemeResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Insyht\Larvelous\Filament\Resources\ThemeResource;
use Insyht\Larvelous\Models\Theme;

class ListThemes extends ListRecords
{
    protected static string $resource = ThemeResource::class;
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected function getTitle(): string
    {
        return __('insyht-larvelous::cms.themes');
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

}
