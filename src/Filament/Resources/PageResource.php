<?php

namespace Insyht\Larvelous\Filament\Resources;

use Insyht\Larvelous\Filament\LanguageFormField;
use Insyht\Larvelous\Filament\Resources\PageResource\Pages\CreatePage;
use Insyht\Larvelous\Filament\Resources\PageResource\Pages\EditPage;
use Insyht\Larvelous\Filament\Resources\PageResource\Pages\ListPages;
use Insyht\Larvelous\Filament\Resources\PageResource\Pages\ViewPage;
use Insyht\Larvelous\Filament\Resources\PageResource\RelationManagers\BlocksRelationManager;
use Insyht\Larvelous\Forms\Components\Dropdown;
use Insyht\Larvelous\Forms\Components\TextInput;
use Insyht\Larvelous\Models\Page;
use Insyht\Larvelous\Models\Template;
use Closure;
use Filament\Forms\Components\Actions\Action;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label(__('insyht-larvelous::cms.title')),
                TextColumn::make('template.label'),
                TextColumn::make('url')->label(__('insyht-larvelous::cms.url')),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make()
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                         ->required()
                         ->reactive()
                         ->afterStateUpdated(function (Closure $set, $state, $context) {
                             if ($context === 'edit') {
                                 return;
                             }

                             $set('url', Str::slug($state));
                         }),
                TextInput::make('url')->unique(ignorable: fn ($record) => $record)
                                      ->prefix(env('APP_URL') . '/')
                                      ->suffixAction(
                                          function (?string $state): Action {
                                              return Action::make(__('insyht-larvelous::cms.viewPage'))
                                                           ->icon('heroicon-s-external-link')
                                                           ->url(
                                                               filled($state)
                                                                    ? env('APP_URL') . '/' . $state
                                                                    : env('APP_URL') . '/',
                                                               shouldOpenInNewTab: true
                                                           );
                                          }
                                      )
                                      ->rules('alpha_dash'),
                Dropdown::make('template_id')->required()
                                             ->options(Template::all()->pluck('label', 'id'))
                                             ->label(__('insyht-larvelous::cms.template')),
                LanguageFormField::create(),
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
        return __('insyht-larvelous::cms.page');
    }

    public static function getPluralModelLabel(): string
    {
        return __('insyht-larvelous::cms.pages');
    }
}
