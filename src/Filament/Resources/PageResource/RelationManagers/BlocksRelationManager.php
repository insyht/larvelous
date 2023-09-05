<?php

namespace Insyht\Larvelous\Filament\Resources\PageResource\RelationManagers;

use Insyht\Larvelous\Forms\Components\BlockFieldInterface;
use Insyht\Larvelous\Forms\Components\Hidden;
use Insyht\Larvelous\Models\BlockTemplate;
use Insyht\Larvelous\Models\BlockVariable;
use Insyht\Larvelous\Models\BlockVariableType;
use Insyht\Larvelous\Models\BlockVariableValue;
use Insyht\Larvelous\Models\Page;
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
                                /** @var \Insyht\Larvelous\Models\Block $currentBlock */
                                $currentBlock = $livewire->getMountedTableActionRecord();
                                /** @var \Insyht\Larvelous\Models\Page $currentPage */
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
                                    $fields[] = static::createFormField($blockValue, $fields);
                                }

                                return $fields;
                            })->mutateRecordDataUsing(function (array $data, RelationManager $livewire) {
                                /** @var \Insyht\Larvelous\Models\Block $currentBlock */
                                $currentBlock = $livewire->getMountedTableActionRecord();
                                /** @var \Insyht\Larvelous\Models\Page $currentPage */
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

                                    if (isset($data['values']) && array_key_exists($pageBlockVariable->name, $data['values'])) {
                                        // We have more than one of this variable for this block.
                                        if (isset($data['values'][$pageBlockVariable->name]['block_id'])) {
                                            // This is the second time we've encountered this variable, convert to array
                                            $backup = $data['values'][$pageBlockVariable->name];
                                            $ordering = $backup['block_variable_value_template_block_ordering'];
                                            $data['values'][$pageBlockVariable->name] = [];
                                            $data['values'][$pageBlockVariable->name][$ordering] = $backup;

                                            //                                            $backup2 = $data[$pageBlockVariable->name];
                                            //                                            $name = $pageBlockVariable->name . '[' . $ordering . ']';
                                            //                                            unset($data[$pageBlockVariable->name]);
                                            //                                            $data[$name] = $backup2;
                                        }
                                        $data['values'][$pageBlockVariable->name][$pageBlockVariable->ordering] = [
                                            'block_id' => $currentBlock->id,
                                            'block_template_ordering' => $blockTemplate->ordering,
                                            'block_variable_value_template_block_ordering' => $pageBlockVariable->ordering,
                                            'value' => $blockValue->value,
                                            'name' => $pageBlockVariable->name,
                                            'block_variable_label' => $pageBlockVariable->label,
                                            'type' => $pageBlockVariable->type,
                                            'require' => $pageBlockVariable->required,
                                        ];
                                        $data[$pageBlockVariable->name . '[' . $pageBlockVariable->ordering . ']'] = $blockValue->value;
                                    } else {
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
                                        $data[$blockValue->blockVariable->name] = $blockValue->value;
                                    }
                                }

                                return $data;
                            })->using(function (Model $record, array $data): Model {
                                $page = Page::find($data['page_id']);
                                $blockTemplate = BlockTemplate::where('template_id', $page->template_id)
                                                              ->where('block_id', $data['block_id'])
                                                              ->where('ordering', $data['page_block_ordering'])
                                                              ->first();
                                $systemValues = ['block_id', 'page_id', 'page_block_ordering', 'block_variable_id'];
                                $counter = 1;
                                foreach ($data as $key => $value) {
                                    if (in_array($key, $systemValues)) {
                                        continue;
                                    }
                                    if (strpos($key, '[') !== false && strpos($key, ']') !== false) {
                                        $orderingWithArrayNotation = substr($key, strpos($key, '['), strpos($key, ']'));
                                        $ordering = (int) str_replace(['[', ']'], '', $orderingWithArrayNotation);
                                        $keyWithoutOrdering = str_replace($orderingWithArrayNotation, '', $key);
                                    } else {
                                        $ordering = $counter;
                                        $keyWithoutOrdering = $key;
                                    }
                                    $counter++;
                                    $blockVariable = BlockVariable::where('block_id', $data['block_id'])
                                                                  ->where('name', $keyWithoutOrdering)
                                                                  ->where('ordering', $ordering)
                                                                  ->first();
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

    protected static function createFormField(BlockVariableValue $data, array $existingFields): Field
    {
        $type = BlockVariableType::find($data->blockVariable->type);

        if (!class_exists($type->fqn) || !is_subclass_of($type->fqn, BlockFieldInterface::class)) {
            $type = BlockVariableType::find(BlockVariableType::TYPE_TEXTFIELD);
        }

        $fieldNameAlreadyExists = false;
        /** @var Field[] $existingFields */
        foreach ($existingFields as $existingField) {
            if ($existingField->getName() === $data->blockVariable->name) {
                $fieldNameAlreadyExists = true;
                break;
            }
        }

        $fieldName = $data->blockVariable->name;
        if ($fieldNameAlreadyExists) {
            $fieldName .= '[' . $data->blockVariable->ordering . ']';
        }
        $field = $type->fqn::make($fieldName);
        $field->label(__($data->blockVariable->label));
        if ($data->blockVariable->required) {
            $field->required();
        }
        $field->setExtraData($data);

        return $field;
    }
}
