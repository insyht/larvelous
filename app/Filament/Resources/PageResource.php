<?php

namespace App\Filament\Resources;

use App\Filament\LanguageFormField;
use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\Pages\CreatePage;
use App\Filament\Resources\PageResource\Pages\EditPage;
use App\Filament\Resources\PageResource\Pages\ListPages;
use App\Filament\Resources\PageResource\Pages\ViewPage;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Filament\Resources\PageResource\RelationManagers\BlocksRelationManager;
use App\Models\Page;
use App\Models\Template;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
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
                EditAction::make()->form(function (EditAction $action): array {
                    $cards = [
                        Card::make()->schema([
                            LanguageFormField::create(),
                            Select::make('template_id')
                                ->options(Template::all()->pluck('label', 'id'))
                                ->required()
                                ->label(__('cms.template')),
                            TextInput::make('title')
                                ->required()
                                ->maxLength(100)
                                ->label(__('cms.title')),
                            TextInput::make('url')
                                ->maxLength(250)
                                ->label(__('cms.url'))
                                ->prefix(url('/') . '/'),
                        ]),
                    ];

                    /** @var Page $page */
                    $page = $action->getModel();
                    $contents = $page->getBlocksContents();
                    foreach ($contents as $block) {
                        $cardSchema = [];
                        foreach ($block['fields'] as $field) {
                            $cardSchema[] = static::createField($field, $block['fieldsPrefix']);
                        }
                        $cards[] = Card::make()->schema($cardSchema);
                    }
                    return $cards;
                }),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
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
