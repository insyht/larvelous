<?php

namespace App\Custom;

use App\Models\BlockVariable;

class PageBlockValue
{
    public $blockId;
    public $blockTemplateOrdering;
    public $blockVariableValueTemplateBlockOrdering;
    public $value;
    public $blockVariableId;
    public $name;
    public $blockVariableLabel;
    public $type;
    public $required;

    /**
     * @param BlockVariable $data created by \App\Model\Page::getBlocksContents()
     */
    public function __construct(BlockVariable $data)
    {
        $this->blockId = $data->block_id;
        $this->blockTemplateOrdering = $data->block_template_ordering;
        $this->blockVariableValueTemplateBlockOrdering = $data->block_variable_value_template_block_ordering;
        $this->value = $data->value;
        $this->blockVariableId = $data->block_variable_id;
        $this->name = $data->name;
        $this->blockVariableLabel = $data->block_variable_label;
        $this->type = $data->type;
        $this->required = $data->required;
    }
}
