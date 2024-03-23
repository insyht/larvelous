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
        $prefix = '';
        if (app()->bound('activeTheme') && app('activeTheme')) {
            $prefix = app('activeTheme')->blade_prefix;
        }

        // If the active theme has a view override, use that. Else, use the default theme view
        $templatePath = view()->exists($prefix . '::' . $this->block->view)
            ? $prefix . '::' . $this->block->view
            : app('defaultTheme')->blade_prefix . '::' . $this->block->view;

        return $templatePath;
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
