<?php

namespace Insyht\Larvelous\Database\Seeders\Pages;

use Insyht\Larvelous\Models\Block;
use Insyht\Larvelous\Models\BlockTemplate;
use Insyht\Larvelous\Models\Language;
use Insyht\Larvelous\Models\Page;
use Insyht\Larvelous\Models\Template;
use Illuminate\Database\Seeder;

class CategoryPageSeeder extends Seeder
{
    public function run()
    {
        $language = Language::where('name', 'Nederlands')->first();

        $template = new Template();
        $template->resource_id = 'iws_category';
        $template->label = 'Category template';
        $template->view = 'insyht-larvelous::base';
        $template->save();
        $template->refresh();
        $paragraphBlock = Block::where('resource_id', 'iws_paragraph')->first();

        $heroBlock = Block::where('resource_id', 'iws_hero')->first();

        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = $heroBlock->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 1;
        $blockTemplate->save();

        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = $paragraphBlock->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 2;
        $blockTemplate->save();

        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = $paragraphBlock->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 3;
        $blockTemplate->save();

        $page = new Page();
        $page->language_id = $language->id;
        $page->template_id = $template->id;
        $page->title = 'Categorie';
        $page->url = 'categorie';
        $page->save();
    }
}
