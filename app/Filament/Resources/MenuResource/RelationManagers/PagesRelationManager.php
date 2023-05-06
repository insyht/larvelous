<?php

namespace App\Filament\Resources\MenuResource\RelationManagers;

use App\Models\Language;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;

class PagesRelationManager extends RelationManager
{
    protected static string $relationship = 'pages';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $modelLabel = null;

    protected static ?string $pluralModelLabel = null;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
//                Forms\Components\Hidden::make('language_id')
//                    ->default(Language::firstWhere('name', 'Nederlands')->id)
//                    ->required(),
//                Forms\Components\Select::make('template_id')
//                    ->options(Page::all()->pluck('title', 'id'))
//                    ->searchable()
//                    ->required()
//                    ->label(__('cms.template')),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
//                Forms\Components\TextInput::make('url')->default(''),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                                         ->label(__('cms.title'))
                                         ->sortable()
                                         ->searchable(isIndividual: true, isGlobal: false),
                Tables\Columns\TextColumn::make('ordering')->label(__('cms.ordering'))->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                            ->preloadRecordSelect()
                            ->form(fn (AttachAction $action): array => [
                                $action->getRecordSelect(),
                                TextInput::make('ordering')->required()->numeric()->label(__('cms.ordering')),
                            ]),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'ordering';
    }

    public static function getModelLabel() : string
    {
        return __('cms.page');
    }

    public static function getPluralModelLabel() : string
    {
        return __('cms.pages');
    }
}
