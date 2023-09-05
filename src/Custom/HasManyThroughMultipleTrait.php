<?php

namespace Insyht\Larvelous\Custom;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasManyThroughMultipleTrait
{
    abstract public function newQuery();

    public function hasManyThroughMultiple(...$classes)
    {
        $query = $this->newQuery();

        $currentModel = $this;
        $baseConstraints = function () use ($query, $currentModel, $classes) {
            /** @var Builder $query */
            /** @var Model $currentModel */
            $previousTable = $currentModel->getTable();
            $previousOwnerKey = $previousTable . '.' . $currentModel->getKeyName();
            foreach ($classes as $class) {
                if (is_array($class)) {
                    $instance = new $class[0]();
                    $tableName = $instance->getTable();
                    $tableForeignKey = $class[1];
                    $value = $class[2];
                } else {
                    /** @var Model $instance */
                    $instance = new $class();
                    $tableName = $instance->getTable();
                    $tableForeignKey = $tableName . '.' . Str::singular($previousTable) . '_id';
                    $value = $previousOwnerKey;
                }

                $query->join($tableName, $tableForeignKey, '=', $value);
                $previousTable = $tableName;
                $previousOwnerKey = $tableName . '.' . $instance->getKeyName();
            }
        };

        return new HasManyThroughMultiple($query, $this, $baseConstraints);
    }
}
