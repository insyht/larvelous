<?php

namespace App\Models;

use App\Custom\HasManyThroughMultipleTrait;
use App\Traits\IsMenuItemable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Query\JoinClause;

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
        return $this->template->blocks();
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
