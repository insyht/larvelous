<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;

class Block extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function blockVariables()
    {
        return $this->hasMany(BlockVariable::class);
    }

    public function variableValues()
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

    public function getId(): int
    {
        return $this->id;
    }
}
