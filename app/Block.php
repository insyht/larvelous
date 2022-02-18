<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $blockValuesInternal = [];

    public function blockVariables()
    {
        return $this->hasMany(BlockVariable::class);
    }

    public function blockVariableValues()
    {
        return $this->hasManyThrough(BlockVariableValue::class, BlockVariable::class);
    }

    public function blockVariableValuesForVariable(string $variableName)
    {
        return $this->hasManyThrough(BlockVariableValue::class, BlockVariable::class)->where('name', $variableName);
    }

    public function blockTemplates()
    {
        return $this->hasMany(BlockTemplate::class);
    }

    public function templates()
    {
        return $this->belongsToMany(Template::class)->using(BlockTemplate::class);
    }

    public function getDottedViewPath(): string
    {
        return str_replace('/', '.', $this->view);
    }

    public function get(Template $template, string $variableName)
    {
        $values = [];

        $variableValues = $this->blockVariableValuesForVariable($variableName)->get();
        foreach ($variableValues as $variableValue) {
            $valuesMatchedByTemplate = $variableValue->blockVariableValueTemplateBlocks->where(
                'template_block_id',
                $template->id
            );
            foreach ($valuesMatchedByTemplate as $templateValue) {
                $index = $templateValue->ordering;
                $values[$index] = $templateValue->blockVariableValue;
            }
        }

        return $values;
    }

    public function getBlockValues(int $index): BlockValues
    {
        return $this->blockValuesInternal[$index] ?? new BlockValues();
    }

    public function addValues(BlockValues $values): void
    {
        $this->blockValuesInternal[] = $values;
    }
}
