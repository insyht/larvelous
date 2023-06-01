<?php

namespace App\Filament\Resources\PageResource\RelationManagers;

use App\Custom\PageBlockValue;
use App\Forms\Components\BlockFieldInterface;
use App\Models\BlockVariableType;
use Filament\Forms\Components\Field;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;

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
                TextColumn::make('label')->label(__('cms.name')),
                TextColumn::make('description')->label(__('cms.description')),
            ])
            ->actions([
                  EditAction::make()
                            ->form(function (EditAction $action, RelationManager $livewire): array {
                                /** @var \App\Models\Block $currentBlock */
                                $currentBlock = $livewire->getMountedTableActionRecord();
                                /** @var \App\Models\Page $currentPage */
                                $currentPage = $livewire->getOwnerRecord();
                                $fields = [];
                                foreach ($currentBlock->getValues($currentPage) as $value) {
                                    $normalizedValue = new PageBlockValue($value);
                                    $fields[] = static::createFormField($normalizedValue);
                                }

                                return $fields;
                            })->mutateRecordDataUsing(function (array $data, RelationManager $livewire) {
                                /** @var \App\Models\Block $currentBlock */
                                $currentBlock = $livewire->getMountedTableActionRecord();
                                /** @var \App\Models\Page $currentPage */
                                $currentPage = $livewire->getOwnerRecord();
                                foreach ($currentBlock->getValues($currentPage) as $value) {
                                    $data[$value->name] = $value->value;
                                }

                                return $data;
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

    protected static function createFormField($data): Field
    {
        $type = BlockVariableType::find($data->type);

        if (!class_exists($type->fqn) || !is_subclass_of($type->fqn, BlockFieldInterface::class)) {
            $type = BlockVariableType::find(BlockVariableType::TYPE_TEXTFIELD);
        }
        $field = $type->fqn::make($data->name);
        $field->label(__($data->blockVariableLabel));
        if ($data->required) {
            $field->required();
        }
        $field->setExtraData($data);

        return $field;
    }
}
