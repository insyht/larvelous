<?php

namespace Insyht\Larvelous\Filament\Resources;

use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Insyht\Larvelous\Filament\LanguageFormField;
use Insyht\Larvelous\Filament\Resources\MenuResource\Pages;
use Insyht\Larvelous\Filament\Resources\MenuResource\RelationManagers;
use Insyht\Larvelous\Forms\Components\Dropdown;
use Insyht\Larvelous\Forms\Components\TextInput;
use Insyht\Larvelous\Models\Menu;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-menu';

    protected static array $positionOptions = ['main_menu' => 'Hoofdmenu', 'footer_menu' => 'Footermenu',];

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 LanguageFormField::create(),
                 TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label(__('insyht-larvelous::cms.name')),
                 Dropdown::make('position')
                    ->options(static::$positionOptions)
                    ->nullable()
                    ->label(__('insyht-larvelous::cms.position')),
                 Dropdown::make('menu_id')
                    ->options(Menu::all()->pluck('name', 'id')->toArray())
                    ->nullable()
                    ->label(__('insyht-larvelous::cms.parentMenu')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                          ->label(__('insyht-larvelous::cms.name'))
                          ->sortable()
                          ->searchable(isIndividual: true),
                TextColumn::make('position')
                          ->enum(static::$positionOptions)
                          ->label(__('insyht-larvelous::cms.position'))
                          ->sortable(),
                TextColumn::make('menu_item')
                            ->label(__('insyht-larvelous::cms.parentMenu'))
                            ->getStateUsing(function (Menu $record) {
                                return $record->menu?->name;
                            }),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\MenuItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'view' => Pages\ViewMenu::route('/{record}'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return true;
    }

    public static function canEdit(Model $record) : bool
    {
        return true;
    }


    public static function getModelLabel() : string
    {
        return __('insyht-larvelous::cms.menu');
    }

    public static function getPluralModelLabel() : string
    {
        return __('insyht-larvelous::cms.menus');
    }
}
