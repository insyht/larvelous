<?php

namespace App\Filament\Resources\PageResource\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;

class BlocksContentsRelationManager extends RelationManager
{
    protected static string $relationship = 'values2';

    protected static ?string $recordTitleAttribute = '';
    protected static bool $shouldIgnorePolicies = true;

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('value')
                                         ->getStateUsing(function (Model $record): string {
                                             return $record->menuitemable->title;
                                         })
                                         ->label(__('cms.title'))
                                         ->sortable()
                                         ->searchable(isIndividual: true, isGlobal: false),
                TextColumn::make('type')
                                         ->getStateUsing(function (Model $record): string {
                                             return __($record->menuitemable->getTypeTranslation());
                                         })
                                         ->label(__('cms.title'))
                                         ->sortable()
                                         ->searchable(isIndividual: true, isGlobal: false),
                TextColumn::make('ordering')->label(__('cms.ordering'))->sortable(),
            ])
            ->filters([
                //
            ]);
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return '';
    }

    public static function getModelLabel() : string
    {
        return '';
    }

    public static function getPluralModelLabel() : string
    {
        return '';
    }
}
