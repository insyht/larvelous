<?php

namespace App\Filament\Resources\PageResource\RelationManagers;

use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlocksRelationManager extends RelationManager
{
    protected static string $relationship = 'blocks';

    protected static ?string $recordTitleAttribute = '';
    protected static bool $shouldIgnorePolicies = true;
    protected bool $allowsDuplicates = true;
    public $tableSortColumn = 'jordy';

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('description')->label(__('cms.name')),
                TextColumn::make('value')
                          ->label(__('cms.value'))
                          ->getStateUsing(function (Model $record): string {
                              /** @var \App\Models\Block $record */
                              return Str::limit($record->value, 50);
                          }),
                TextColumn::make('resource_id')->label(__('cms.value')),
                TextColumn::make('block_template_ordering')->label(__('cms.ordering'))->sortable(),
            ])
            ->actions([
                          EditAction::make()->form(function (EditAction $action): array {
                              return [
                                  TextInput::make('description')->label(__('cms.name')),
                                  TextInput::make('value')->label(__('cms.name')),
                              ];
                          }),
            ])
            ->filters([])->bulkActions([]);
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'ordering';
    }

    public static function getModelLabel() : string
    {
        return __('cms.block');
    }

    public static function getPluralModelLabel() : string
    {
        return __('cms.blocks');
    }
}
