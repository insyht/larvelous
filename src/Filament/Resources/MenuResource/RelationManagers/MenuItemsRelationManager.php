<?php

namespace Insyht\Larvelous\Filament\Resources\MenuResource\RelationManagers;

use Illuminate\Support\Facades\Log;
use Insyht\Larvelous\Forms\Components\TextInput;
use Insyht\Larvelous\Interfaces\MenuItemInterface;
use Insyht\Larvelous\Models\MenuItemType;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\MorphToSelect\Type;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class MenuItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $recordTitleAttribute = 'title';

    protected static function getMenuItemTypes(): array
    {
        $typesArray = [];
        $types = MenuItemType::all();
        foreach ($types as $type) {
            $classname = $type->classname;
            $column = $type->title_column;
            $menuItemObject = new $classname();
            if ($menuItemObject instanceof MenuItemInterface) {
                $label = $menuItemObject->getTypeTranslation();
                $typesArray[] = Type::make($classname)->titleColumnName($column)->label($label);
            } else {
                Log::warning('Class ' . $classname . ' does not implement MenuItemInterface');
            }
        }

        return $typesArray;
    }

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                MorphToSelect::make('menuitemable')->types(static::getMenuItemTypes())
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('ordering')
            ->columns([
                TextColumn::make('title')
                                         ->getStateUsing(function (Model $record): string {
                                             return $record->menuitemable->{$record->getTitleColumn()};
                                         })
                                         ->label(__('insyht-larvelous::cms.title'))
                                         ->sortable()
                                         ->searchable(isIndividual: true, isGlobal: false),
                TextColumn::make('type')
                                         ->getStateUsing(function (Model $record): string {
                                             return __($record->menuitemable->getTypeTranslation());
                                         })
                                         ->label(__('insyht-larvelous::cms.type'))
                                         ->sortable()
                                         ->searchable(isIndividual: true, isGlobal: false),
                TextColumn::make('ordering')->label(__('insyht-larvelous::cms.ordering'))->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()->form(fn (CreateAction $action): array => [
                    MorphToSelect::make('menuitemable')
                                 ->types(static::getMenuItemTypes())
                                 ->label(__('insyht-larvelous::cms.menuItemType'))
                                 ->required(),
                    TextInput::make('ordering')->required()->numeric()->label(__('insyht-larvelous::cms.ordering')),
                ])
            ])
            ->actions([
                EditAction::make()->form(function (EditAction $action): array
                {
                    return [
                        MorphToSelect::make('menuitemable')
                                     ->types(static::getMenuItemTypes())
                                     ->label(__('insyht-larvelous::cms.menuItemType'))
                                     ->required(),
                        TextInput::make('ordering')->required()->numeric()->label(__('insyht-larvelous::cms.ordering')),
                    ];
                }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'ordering';
    }

    public static function getModelLabel() : string
    {
        return __('insyht-larvelous::cms.item');
    }

    public static function getPluralModelLabel() : string
    {
        return __('insyht-larvelous::cms.items');
    }
}
