<?php

namespace App\Filament\Resources;

use App\Filament\LanguageFormField;
use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Forms\Components\ExistingImageUpload;
use App\Models\Page;
use App\Models\Template;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\EditAction;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

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
                EditAction::make()->form(function (EditAction $action): array {
                    $cards = [
                        Card::make()->schema([
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
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\BlocksRelationManager::class,
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


    public static function getModelLabel(): string
    {
        return __('cms.page');
    }

    public static function getPluralModelLabel(): string
    {
        return __('cms.pages');
    }

    protected static function addFieldToSchema(array $schema, array $field, string $namePrefix = ''): array
    {
        $field = match ($field['type']) {
            'image' => ExistingImageUpload::make($namePrefix . $field['name'])
                                          ->preserveFilenames()
                                          ->image()
                                          ->value($field['value'])
                                          ->required($field['required'] && empty($field['value']))
                                          ->label(__($field['label'])),
            'dropdown' => Select::make($namePrefix . $field['name'])
                                ->options($field['options'] ?? [])
                                ->searchable()
                                ->required($field['required'])
                                ->label(__($field['label'])),
            'textarea' => Textarea::make($namePrefix . $field['name'])
                                  ->label(__($field['label']))
                                  ->required($field['required']),
            default => TextInput::make($namePrefix . $field['name'])
                                ->label(__($field['label']))
                                ->required($field['required']),
        };

        $schema[] = $field;

        return $schema;
    }
}
