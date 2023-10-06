<?php

namespace Insyht\Larvelous\Database\Seeders\Category;

use Insyht\Larvelous\Models\Block;
use Insyht\Larvelous\Models\BlockTemplate;
use Insyht\Larvelous\Models\Template;
use Illuminate\Database\Seeder;

class BlockTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $template = Template::where('resource_id', 'iws_category')->first();
        $heroBlock = Block::where('resource_id', 'iws_hero')->first();

        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = $heroBlock->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 1;
        $blockTemplate->save();
    }
}
