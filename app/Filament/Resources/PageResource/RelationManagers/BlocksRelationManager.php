<?php

namespace App\Filament\Resources\PageResource\RelationManagers;

use App\Custom\PageBlockValue;
use App\Forms\Components\BlockFieldInterface;
use App\Models\BlockTemplate;
use App\Models\BlockVariable;
use App\Models\BlockVariableType;
use App\Models\BlockVariableValue;
use App\Models\BlockVariableValueTemplateBlock;
use App\Models\Page;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Hidden;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

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
                                $fields[] = Hidden::make('block_id');
                                $fields[] = Hidden::make('page_id');
                                $fields[] = Hidden::make('page_block_ordering');

                                return $fields;
                            })->mutateRecordDataUsing(function (array $data, RelationManager $livewire) {
                                /** @var \App\Models\Block $currentBlock */
                                $currentBlock = $livewire->getMountedTableActionRecord();
                                /** @var \App\Models\Page $currentPage */
                                $currentPage = $livewire->getOwnerRecord();
                                foreach ($currentBlock->getValues($currentPage) as $value) {
                                    $data[$value->name] = $value->value;
                                    $data['values'][$value->name] = $value->toArray();
                                }
                                $data['block_id'] = $currentBlock->id;
                                $data['page_id'] = $currentPage->id;
                                $data['page_block_ordering'] = $currentBlock->ordering;
                                $data['block_template_id'] = BlockTemplate::where('block_id', $currentBlock->id)
                                                                          ->where('template_id', $currentPage->template_id)
                                                                          ->where('ordering', $currentBlock->ordering)
                                                                          ->first()
                                                                          ->id;

                                return $data;
                            })->using(function (Model $record, array $data): Model {
                                $page = Page::find($data['page_id']);
                                $blockTemplate = BlockTemplate::where('template_id', $page->template_id)
                                                              ->where('block_id', $data['block_id'])
                                                              ->where('ordering', $data['page_block_ordering'])
                                                              ->first();
                                $systemValues = ['block_id', 'page_id', 'page_block_ordering'];
                                foreach ($data as $key => $value) {
                                    if (!in_array($key, $systemValues)) {
                                        $blockVariable = BlockVariable::where('block_id', $data['block_id'])
                                                                      ->where('name', $key)
                                                                      ->first();

                                        $blockVariableValues = BlockVariableValue::where(
                                            'block_variable_id',
                                            $blockVariable->id
                                        )->get();

                                        $blockVariableValueTemplateBlocks = BlockVariableValueTemplateBlock::where(
                                            'block_template_id',
                                            $blockTemplate->id
                                        )->whereIn('block_variable_value_id', $blockVariableValues->pluck('id'))->get();

                                        $blockVariableValue = BlockVariableValue::where(
                                            'block_variable_id',
                                            $blockVariable->id
                                        )->whereIn(
                                            'id',
                                            $blockVariableValueTemplateBlocks->pluck('block_variable_value_id')
                                        )->first();

                                        $blockVariableValue->value = $data[$blockVariable->name];
                                        $blockVariableValue->save();
                                    }
                                }

                                return $record;
                            }),
            ])
            ->filters([])
            ->bulkActions([]);
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'ordering';
    }

    public static function getModelLabel(): string
    {
        return __('cms.block');
    }

    public static function getPluralModelLabel(): string
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
