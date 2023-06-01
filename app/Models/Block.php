<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function blockVariables()
    {
        return $this->hasMany(BlockVariable::class);
    }

    public function templates()
    {
        return $this->belongsToMany(Template::class)->using(BlockTemplate::class);
    }

    public function getDottedViewPath(): string
    {
        return str_replace('/', '.', $this->view);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getValues(Page $page): Collection
    {
        $currentBlock = $this;
        $query = $this->blockVariables();
        $query
            ->join('pages', function ($join) use ($page) {
                $join->where('pages.id', $page->id);
            })
            ->join('block_template', function ($join) use ($currentBlock) {
                $join->on('block_template.template_id', '=', 'pages.template_id');
                $join->where('block_template.block_id', $currentBlock->id);
            })
            ->join(
                'block_variable_value_template_blocks',
                'block_variable_value_template_blocks.block_template_id',
                '=',
                'block_template.id'
            )
            ->join('block_variable_values', function ($join) {
                $join->on(
                    'block_variable_values.id',
                    '=',
                    'block_variable_value_template_blocks.block_variable_value_id'
                );
                $join->on('block_variable_values.block_variable_id', '=', 'block_variables.id');
            })
            ->where('block_variables.block_id', $currentBlock->id)
            ->select(
                'block_template.block_id',
                'block_template.ordering AS block_template_ordering',
                'block_variable_value_template_blocks.ordering AS block_variable_value_template_block_ordering',
                'block_variable_values.value AS value',
                'block_variables.id AS block_variable_id',
                'block_variables.name',
                'block_variables.label AS block_variable_label',
                'block_variables.type',
                'block_variables.required'
            );

        return $query->get();
    }
}
