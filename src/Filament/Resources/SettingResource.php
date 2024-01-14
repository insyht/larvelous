<?php

namespace Insyht\Larvelous\Filament\Resources;

use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Insyht\Larvelous\Filament\Resources\SettingResource\Pages\ManageSettings;
use Insyht\Larvelous\Models\Setting;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Illuminate\Database\Eloquent\Model;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('insyht-larvelous::cms.setting'))->sortable()->searchable(),
                TextColumn::make('value')->label(__('insyht-larvelous::cms.value'))->sortable()->searchable(),
            ])
            ->actions([
               EditAction::make()
                    ->form(function (Setting $record) {
                        return [TextInput::make('value')->label($record->name)];
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageSettings::route('/'),
        ];
    }
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record) : bool
    {
        return auth()->user()->hasRole('admin') || !$record->hidden;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }


    public static function getModelLabel() : string
    {
        return __('insyht-larvelous::cms.setting');
    }

    public static function getPluralModelLabel() : string
    {
        return __('insyht-larvelous::cms.settings');
    }
}
