<?php

namespace App\Custom;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class HasManyThroughMultiple extends \Illuminate\Database\Eloquent\Relations\Relation
{
    protected Closure $baseConstraints;

    public function __construct(Builder $query, Model $parent, Closure $baseConstraints)
    {
        $this->baseConstraints = $baseConstraints;

        parent::__construct($query, $parent);
    }

    /**
     * @inheritDoc
     */
    public function addConstraints()
    {
        call_user_func($this->baseConstraints, $this);
    }

    /**
     * @inheritDoc
     */
    public function addEagerConstraints(array $models)
    {
        // TODO: Implement addEagerConstraints() method.
        $a = 0;
    }

    /**
     * @inheritDoc
     */
    public function initRelation(array $models, $relation)
    {
        // TODO: Implement initRelation() method.
        $a = 0;
    }

    /**
     * @inheritDoc
     */
    public function match(array $models, Collection $results, $relation)
    {
        // TODO: Implement match() method.
        $a = 0;
    }

    /**
     * @inheritDoc
     */
    public function getResults()
    {
        return $this->get();
    }
}
