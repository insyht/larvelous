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
        $view = $this->block->view;

        // Use the active theme's Blade template for this block if it exists
        $activeTheme = app('activeTheme');
        if ($activeTheme->blocks->contains($this->block)) {
            $templatePath = strtolower(str_replace('\\', '-', $activeTheme->namespace))
                            . '::'
                            . $activeTheme->blocks()->where('block_id', $this->block->id)->first()->pivot->template_path;

            if (view()->exists($templatePath)) {
                return $templatePath;
            }
        }

        return $view;
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
