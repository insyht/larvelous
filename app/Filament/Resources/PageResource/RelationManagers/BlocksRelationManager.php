<?php

namespace App\Filament\Resources\PageResource\RelationManagers;

use App\Forms\Components\BlockFieldInterface;
use App\Forms\Components\Hidden;
use App\Models\BlockTemplate;
use App\Models\BlockVariable;
use App\Models\BlockVariableType;
use App\Models\BlockVariableValue;
use App\Models\Page;
use Filament\Forms\Components\Field;
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
                                $fields = [
                                    Hidden::make('block_id'),
                                    Hidden::make('page_id'),
                                    Hidden::make('page_block_ordering'),
                                ];
                                $blockTemplate = BlockTemplate::where('block_id', $currentBlock->id)
                                                              ->where('template_id', $currentPage->template_id)
                                                              ->where('ordering', $currentBlock->ordering)
                                                              ->first();
                                foreach ($currentBlock->blockVariables()->get() as $pageBlockVariable) {
                                    $blockValue = $pageBlockVariable->blockVariableValues()
                                                                    ->forPageAndBlockTemplate($currentPage, $blockTemplate)
                                                                    ->first();
                                    if ($blockValue === null) {
                                        $blockValue = new BlockVariableValue();
                                        $blockValue->block_variable_id = $pageBlockVariable->id;
                                        $blockValue->language_id = $currentPage->language_id;
                                        $blockValue->page_id = $currentPage->id;
                                        $blockValue->value = '';
                                        $blockValue->block_template_id = $blockTemplate->id;
                                        $blockValue->save();
                                        $blockValue->refresh();
                                    }
                                    $fields[] = static::createFormField($blockValue);
                                }

                                return $fields;
                            })->mutateRecordDataUsing(function (array $data, RelationManager $livewire) {
                                /** @var \App\Models\Block $currentBlock */
                                $currentBlock = $livewire->getMountedTableActionRecord();
                                /** @var \App\Models\Page $currentPage */
                                $currentPage = $livewire->getOwnerRecord();

                                $blockTemplate = BlockTemplate::where('block_id', $currentBlock->id)
                                                              ->where('template_id', $currentPage->template_id)
                                                              ->where('ordering', $currentBlock->ordering)
                                                              ->first();

                                $data['block_id'] = $currentBlock->id;
                                $data['page_id'] = $currentPage->id;
                                $data['page_block_ordering'] = $currentBlock->ordering;
                                $data['block_template_id'] = $blockTemplate->id;

                                foreach ($currentBlock->blockVariables()->get() as $pageBlockVariable) {
                                    $blockValue = $pageBlockVariable->blockVariableValues()
                                                                    ->forPageAndBlockTemplate($currentPage, $blockTemplate)
                                                                    ->first();
                                    if ($blockValue === null) {
                                        $blockValue = new BlockVariableValue();
                                        $blockValue->block_variable_id = $pageBlockVariable->id;
                                        $blockValue->language_id = $currentPage->language_id;
                                        $blockValue->page_id = $currentPage->id;
                                        $blockValue->value = 'x';
                                        $blockValue->block_template_id = $blockTemplate->id;
                                        $blockValue->save();
                                        $blockValue->refresh();
                                    }
                                    $data['block_variable_id'] = $pageBlockVariable->id;

                                    $data[$blockValue->blockVariable->name] = $blockValue->value;
                                    $data['values'][$pageBlockVariable->name] = [
                                        'block_id' => $currentBlock->id,
                                        'block_template_ordering' => $blockTemplate->ordering,
                                        'block_variable_value_template_block_ordering' => $pageBlockVariable->ordering,
                                        'value' => $blockValue->value,
                                        'name' => $pageBlockVariable->name,
                                        'block_variable_label' => $pageBlockVariable->label,
                                        'type' => $pageBlockVariable->type,
                                        'require' => $pageBlockVariable->required,
                                    ];
                                }

                                return $data;
                            })->using(function (Model $record, array $data): Model {
                                $page = Page::find($data['page_id']);
                                $blockTemplate = BlockTemplate::where('template_id', $page->template_id)
                                                              ->where('block_id', $data['block_id'])
                                                              ->where('ordering', $data['page_block_ordering'])
                                                              ->first();
                                $systemValues = ['block_id', 'page_id', 'page_block_ordering', 'block_variable_id'];
                                $blockVariablesCounter = 1;
                                foreach ($data as $key => $value) {
                                    if (in_array($key, $systemValues)) {
                                        continue;
                                    }
                                    $blockVariable = BlockVariable::where('block_id', $data['block_id'])
                                                                  ->where('name', $key)
                                                                  ->where('ordering', $blockVariablesCounter)
                                                                  ->first();
                                    $blockVariablesCounter++;
                                    $blockVariableValue = BlockVariableValue::where('language_id', $page->language_id)
                                                                            ->where('page_id', $data['page_id'])
                                                                            ->where('block_template_id', $blockTemplate->id)
                                                                            ->where('block_variable_id', $blockVariable->id)
                                                                            ->first();

                                    $blockVariableValue->value = $value;
                                    if ($value === null) {
                                        $blockVariableValue->value = '';
                                    }
                                    $blockVariableValue->save();
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

    protected static function createFormField(BlockVariableValue $data): Field
    {
        $type = BlockVariableType::find($data->blockVariable->type);

        if (!class_exists($type->fqn) || !is_subclass_of($type->fqn, BlockFieldInterface::class)) {
            $type = BlockVariableType::find(BlockVariableType::TYPE_TEXTFIELD);
        }

        $field = $type->fqn::make($data->blockVariable->name);
        $field->label(__($data->blockVariable->label));
        if ($data->blockVariable->required) {
            $field->required();
        }
        $field->setExtraData($data);

        return $field;
    }
}
