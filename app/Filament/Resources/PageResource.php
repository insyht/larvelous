<?php

namespace App\Filament\Resources;

use App\Filament\LanguageFormField;
use App\Filament\Resources\PageResource\Pages\CreatePage;
use App\Filament\Resources\PageResource\Pages\EditPage;
use App\Filament\Resources\PageResource\Pages\ListPages;
use App\Filament\Resources\PageResource\Pages\ViewPage;
use App\Filament\Resources\PageResource\RelationManagers\BlocksRelationManager;
use App\Models\Page;
use App\Models\Template;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label(__('cms.title')),
                TextColumn::make('template.label'),
                TextColumn::make('url')->label(__('cms.url')),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make()
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                TextInput::make('url')->unique()
                                      ->prefix(env('APP_URL') . '/')
                                      ->suffixAction(
                                          function (?string $state): Action {
                                              return Action::make(__('cms.viewPage'))
                                                           ->icon('heroicon-s-external-link')
                                                           ->url(
                                                               filled($state)
                                                                    ? env('APP_URL') . '/' . $state
                                                                    : env('APP_URL') . '/',
                                                               shouldOpenInNewTab: true
                                                           );
                                          }
                                      ),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            BlocksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPages::route('/'),
            'create' => CreatePage::route('/create'),
            'view' => ViewPage::route('/{record}'),
            'edit' => EditPage::route('/{record}/edit'),
        ];
    }


    public static function getModelLabel(): string
    {
        return __('cms.page');
    }

    public static function getPluralModelLabel(): string
    {
        return __('cms.pages');
    }
}
