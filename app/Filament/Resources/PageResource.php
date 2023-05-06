<?php

namespace App\Filament\Resources;

use App\Filament\LanguageFormField;
use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use App\Models\Template;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                LanguageFormField::create(),
                Forms\Components\Select::make('template_id')
                    ->options(Template::all()->pluck('label', 'id'))
                    ->required()
                    ->label(__('cms.template')),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(100)
                    ->label(__('cms.title')),
                Forms\Components\TextInput::make('url')
                    ->required()
                    ->maxLength(250)
                    ->label(__('cms.url'))
                    ->prefix(url('/') . '/'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label(__('cms.title')),
                Tables\Columns\TextColumn::make('template.label'),
                Tables\Columns\TextColumn::make('url')->label(__('cms.url')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'view' => Pages\ViewPage::route('/{record}'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
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
