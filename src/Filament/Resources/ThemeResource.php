<?php

namespace Insyht\Larvelous\Filament\Resources;

use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Insyht\Larvelous\Filament\Resources\ThemeResource\Pages\ListThemes;
use Insyht\Larvelous\Models\Theme;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Illuminate\Database\Eloquent\Model;
use Storage;

class ThemeResource extends Resource
{
    protected static ?string $model = Theme::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->contentGrid(['md' => 2])
            ->columns([
                          TextColumn::make('name')
                                    ->weight('bold')
                                    ->fontFamily('serif')
                                    ->extraAttributes(['class' => 'text-xl'])
                                    ->description(function (Theme $record) {
                                        return $record->active ? __('insyht-larvelous::cms.active') : '';
                                    }),
                          TextColumn::make('author')->extraAttributes(['class' => 'italic']),
                          ImageColumn::make('image')
                                     ->url(fn(Theme $record) => Storage::url($record->image))
                                     ->width('500px')
                                     ->height('250px')
                          ->defaultImageUrl(Storage::url('images/placeholder.jpg'))
                      ])
            ->filters([])
            ->actions([
                          Action::make('activate')
                                ->action('activate')
                                ->label(__('insyht-larvelous::cms.activate'))
                                ->visible(function (Theme $record): bool { return !$record->active; })
                                ->color('success')
                                ->size('lg'),
                          DeleteAction::make('delete')
                                      ->action('delete')
                                      ->label(__('insyht-larvelous::cms.delete'))
                                      ->visible(function (Theme $record): bool { return $record->id !== app('defaultTheme')->id; })
                                      ->size('lg')
                      ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListThemes::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record) : bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return $record->id !== app('defaultTheme')->id;
    }


    public static function getModelLabel() : string
    {
        return __('insyht-larvelous::cms.theme');
    }

    public static function getPluralModelLabel() : string
    {
        return __('insyht-larvelous::cms.themes');
    }
}
