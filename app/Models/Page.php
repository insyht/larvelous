<?php

namespace App\Models;

use App\Custom\HasManyThroughMultipleTrait;
use App\Traits\IsMenuItemable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection;

class Page extends Model
{
    use HasFactory;
    use IsMenuItemable;
    use HasManyThroughMultipleTrait;

    public $timestamps = false;

    protected $fillable = ['language_id', 'template_id', 'title', 'url'];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function blocks()
    {
        $relation = $this->template->blocks();
        $relation->getQuery()
            ->join('block_variable_value_template_blocks', 'block_variable_value_template_blocks.block_template_id', '=', 'block_template.id')
            ->join('block_variable_values', 'block_variable_values.id', '=', 'block_variable_value_template_blocks.block_variable_value_id')
            ->join('block_variables', function (JoinClause $join) {
                $join->on('block_variables.id', '=', 'block_variable_values.block_variable_id')
                     ->on('block_variables.block_id', '=', 'blocks.id');
            })->select(
                'blocks.id',
                'block_template.block_id',
                'block_template.enabled',
                'block_template.ordering AS block_template_ordering',
                'blocks.resource_id',
                'blocks.view',
                'blocks.label AS block_label',
                'blocks.description',
                'block_variable_value_template_blocks.ordering AS block_variable_value_template_block_ordering',
                'block_variable_values.value AS value',
                'block_variables.name',
                'block_variables.label AS block_variable_label',
                'block_variables.type',
                'block_variables.required'
            );

        return $relation;
    }

    public function getBlocks()
    {
        return $this->template->blockTemplates;
    }

    public function getBlocksContents(): array
    {
        $contents = [];

        $pageBlocksSettings = $this->template->blockTemplates;
        foreach ($pageBlocksSettings as $pageBlockSetting) {
            $pageBlockDataSettings = $pageBlockSetting->blockVariableValueTemplateBlocks;
            $blockArray = [
                'enabled' => (bool) $pageBlockSetting->enabled,
                'fieldsPrefix' => $pageBlockSetting->block_id . '_' . $pageBlockSetting->ordering . '_',
                'fields' => [],
            ];
            foreach ($pageBlockDataSettings as $pageBlockDataSetting) {
                $value = $pageBlockDataSetting->blockVariableValue->value ?? null;
                $variable = $pageBlockDataSetting->blockVariableValue->blockVariable;
                $options = [];
                if ($variable->blockVariableOptions) {
                    foreach ($variable->blockVariableOptions as $option) {
                        $options[$option->value] = $option->label;
                    }
                }
                $blockArray['fields'][$pageBlockDataSetting->ordering] = [
                    'type' => $variable->type,
                    'required' => (bool) $variable->required,
                    'name' => $variable->name,
                    'label' => $variable->label,
                    'value' => $value,
                    'options' => $options,
                ];
            }
            $contents[(int) $pageBlockSetting->ordering] = $blockArray;
        }

        return $contents;
    }

    public function menuitems(): MorphMany
    {
        return $this->morphMany(MenuItem::class, 'menuitemable');
    }

    protected function url(): Attribute
    {
        // The url of a page may also be an empty string (for the homepage for example), but Laravel will convert that
        // to null. This mutator forces it into a string, even if empty.
        return Attribute::make(
            get: fn (?string $value) => (string) $value,
            set: fn (?string $value) => (string) $value,
        );
    }
}
