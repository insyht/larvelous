<?php

namespace Insyht\Larvelous\Filament\Resources;

use Insyht\Larvelous\Filament\LanguageFormField;
use Insyht\Larvelous\Filament\Resources\MenuResource\Pages;
use Insyht\Larvelous\Filament\Resources\MenuResource\RelationManagers;
use Insyht\Larvelous\Forms\Components\Dropdown;
use Insyht\Larvelous\Forms\Components\TextInput;
use Insyht\Larvelous\Models\Menu;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

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
                    ->label(__('cms.name')),
                 Dropdown::make('position')
                    ->options(static::$positionOptions)
                    ->required()
                    ->label(__('cms.position')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                                         ->label(__('cms.name'))
                                         ->sortable()
                                         ->searchable(isIndividual: true),
                TextColumn::make('position')
                                         ->enum(static::$positionOptions)
                                         ->label(__('cms.position'))
                                         ->sortable(),



            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
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
        return false;
    }

    public static function canEdit(Model $record) : bool
    {
        return false;
    }


    public static function getModelLabel() : string
    {
        return __('cms.menu');
    }

    public static function getPluralModelLabel() : string
    {
        return __('cms.menus');
    }
}
