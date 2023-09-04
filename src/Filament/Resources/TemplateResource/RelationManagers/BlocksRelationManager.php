<?php

namespace App\Filament\Resources\TemplateResource\RelationManagers;

use App\Forms\Components\Hidden;
use App\Forms\Components\TextInput;
use App\Models\BlockTemplate;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\DetachBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class BlocksRelationManager extends RelationManager
{
    protected static string $relationship = 'blocks';
    protected static ?string $recordTitleAttribute = 'label';
    protected bool $allowsDuplicates = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Toggle::make('enabled')
                      ->onColor('success')
                      ->offColor('danger')
                      ->required()
                      ->inline(false)
                      ->label(__('cms.enabled')),
                TextInput::make('ordering')->required()->numeric()->label(__('cms.ordering')),
                Hidden::make('template_id'),
                Hidden::make('pivot_ordering'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label'),
                ToggleColumn::make('enabled')->label(__('cms.enabled')),
                TextColumn::make('ordering')->label(__('cms.ordering')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                            ->preloadRecordSelect()
                            ->form(function (AttachAction $action): array {
                                return [
                                    $action->getRecordSelect(),
                                    TextInput::make('ordering')->required()->numeric()->label(__('cms.ordering')),
                                    Toggle::make('enabled')
                                          ->required()
                                          ->default(true)
                                          ->onColor('success')
                                          ->offColor('danger')
                                          ->label(__('cms.enabled')),
                                ];
                            }),
            ])
            ->actions([
                  EditAction::make()
                            ->using(function (Model $record, array $data): Model {
                                $block = $record;
                                /** @var BlockTemplate $blockTemplate */
                                $blockTemplate = BlockTemplate::where('template_id', $data['template_id'])
                                                              ->where('block_id', $block->id)
                                                              ->where('ordering', $data['pivot_ordering'])
                                                              ->first();
                                if ($blockTemplate->exists) {
                                    $blockTemplate->ordering = $data['ordering'];
                                    $blockTemplate->enabled = $data['enabled'];
                                    $blockTemplate->save();
                                }

                                return $record;
                            }),
                  DetachAction::make(),
            ])
            ->bulkActions([
                DetachBulkAction::make(),
            ])
            ->reorderable('ordering');
    }

    public static function getModelLabel(): string
    {
        return __('cms.block');
    }

    public static function getPluralModelLabel(): string
    {
        return __('cms.blocks');
    }


    protected function getTableQuery(): Builder | Relation
    {
        return parent::getTableQuery()->with('templates');
    }
}
