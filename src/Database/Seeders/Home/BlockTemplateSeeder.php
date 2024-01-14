<?php

namespace Insyht\Larvelous\Database\Seeders\Home;

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
        $template = Template::where('resource_id', 'iws_home')->first();
        $paragraphBlock = Block::where('resource_id', 'iws_paragraph')->first();
        $imageAttentionBlock = Block::where('resource_id', 'iws_image_attention')->first();
        $newsletterBlock = Block::where('resource_id', 'iws_newsletter')->first();
        $ctaBlock = Block::where('resource_id', 'iws_cta')->first();

        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = $paragraphBlock->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 3;
        $blockTemplate->save();

        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = $paragraphBlock->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 2;
        $blockTemplate->save();

        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = $imageAttentionBlock->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 1;
        $blockTemplate->save();

        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = $paragraphBlock->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 4;
        $blockTemplate->save();

        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = $paragraphBlock->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 5;
        $blockTemplate->save();

        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = $newsletterBlock->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 6;
        $blockTemplate->save();

        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = $ctaBlock->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 7;
        $blockTemplate->save();

    }
}
