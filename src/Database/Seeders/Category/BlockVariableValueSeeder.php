<?php

namespace Insyht\Larvelous\Database\Seeders\Category;

use Insyht\Larvelous\Models\Block;
use Insyht\Larvelous\Models\BlockTemplate;
use Insyht\Larvelous\Models\BlockVariable;
use Insyht\Larvelous\Models\BlockVariableValue;
use Insyht\Larvelous\Models\Language;
use Insyht\Larvelous\Models\Page;
use Insyht\Larvelous\Models\Template;
use Illuminate\Database\Seeder;

class BlockVariableValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $language = Language::where('name', 'Nederlands')->first();
        $page = Page::where('title', 'Categorie')->first();

        $heroBlock = Block::where('resource_id', 'iws_hero')->first();

        $heroImageBlockVariable = BlockVariable::where('name', 'image')->where('block_id', $heroBlock->id)->first();
        $heroTextBlockVariable = BlockVariable::where('name', 'text')->where('block_id', $heroBlock->id)->first();

        $template = Template::where('resource_id', 'iws_category')->first();
        $baseHeroTemplateBlock = BlockTemplate::where('block_id', $heroBlock->id)
                                          ->where('template_id', $template->id)
                                          ->first();

        $paragraphBlock = Block::where('resource_id', 'iws_paragraph')->first();
        $paragraphTitleBlockVariable = BlockVariable::where('name', 'title')->where('block_id', $paragraphBlock->id)->first();
        $paragraphTextBlockVariable = BlockVariable::where('name', 'text')->where('block_id', $paragraphBlock->id)->first();
        $paragraphImageBlockVariable = BlockVariable::where('name', 'image')->where('block_id', $paragraphBlock->id)->first();
        $paragraphUrlBlockVariable = BlockVariable::where('name', 'url')->where('block_id', $paragraphBlock->id)->first();
        $paragraphUrlTextBlockVariable = BlockVariable::where('name', 'url_text')->where('block_id', $paragraphBlock->id)->first();
        $paragraphImagePositionBlockVariable1 = BlockVariable::where('name', 'image_position')->where('block_id', $paragraphBlock->id)->first();

        $baseParagraphTemplateBlock1 = BlockTemplate::where('block_id', $paragraphBlock->id)
                                                    ->where('template_id', $template->id)
                                                    ->where('ordering', 2)
                                                    ->first();
        $baseParagraphTemplateBlock2 = BlockTemplate::where('block_id', $paragraphBlock->id)
                                                    ->where('template_id', $template->id)
                                                    ->where('ordering', 3)
                                                    ->first();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $heroImageBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'images/placeholder.jpg';
        $blockVariableValue->block_template_id = $baseHeroTemplateBlock->id;
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $heroTextBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'Category text';
        $blockVariableValue->block_template_id = $baseHeroTemplateBlock->id;
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphTitleBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock1->id;
        $blockVariableValue->value = 'Category titel';
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphTextBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock1->id;
        $blockVariableValue->value = 'Category text';
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphImageBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock1->id;
        $blockVariableValue->value = 'images/placeholder.jpg';
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphUrlBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock1->id;
        $blockVariableValue->value = 'category.com';
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphUrlTextBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock1->id;
        $blockVariableValue->value = 'category link';
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue(); // id=18
        $blockVariableValue->block_variable_id = $paragraphImagePositionBlockVariable1->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock1->id;
        $blockVariableValue->value = '';
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphTitleBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock2->id;
        $blockVariableValue->value = '';
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphTextBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock2->id;
        $blockVariableValue->value = '';
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphImageBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock2->id;
        $blockVariableValue->value = '';
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphUrlBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock2->id;
        $blockVariableValue->value = '';
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphUrlTextBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock2->id;
        $blockVariableValue->value = '';
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue(); // id=18
        $blockVariableValue->block_variable_id = $paragraphImagePositionBlockVariable1->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock2->id;
        $blockVariableValue->value = '';
        $blockVariableValue->save();
    }
}
