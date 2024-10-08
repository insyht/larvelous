<?php

namespace Insyht\Larvelous\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BlockTemplate extends Pivot
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = true;
    protected $blockValuesInternal;

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function getView()
    {
        return $this->block->view;
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function getBlockValues(): BlockValues
    {
        return $this->blockValuesInternal ?? new BlockValues();
    }

    public function addValues(BlockValues $values): void
    {
        $this->blockValuesInternal = $values;
    }
}
