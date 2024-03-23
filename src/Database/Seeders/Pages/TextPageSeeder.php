<?php

namespace Insyht\Larvelous\Database\Seeders\Pages;

use Insyht\Larvelous\Models\Block;
use Insyht\Larvelous\Models\BlockTemplate;
use Insyht\Larvelous\Models\BlockVariable;
use Insyht\Larvelous\Models\BlockVariableValue;
use Insyht\Larvelous\Models\Language;
use Insyht\Larvelous\Models\Page;
use Insyht\Larvelous\Models\Template;
use Illuminate\Database\Seeder;

class TextPageSeeder extends Seeder
{
    public function run()
    {
        $language = Language::where('name', 'Nederlands')->first();

        $template = new Template();
        $template->resource_id = 'iws_textual_page';
        $template->label = 'Textual page template';
        $template->view = 'base';
        $template->save();
        $template->refresh();

        $paragraphBlock = Block::where('resource_id', 'iws_paragraph')->first();
        $ctaBlock = Block::where('resource_id', 'iws_cta')->first();
        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = $paragraphBlock->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 1;
        $blockTemplate->save();
        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = $paragraphBlock->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 2;
        $blockTemplate->save();        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = $paragraphBlock->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 3;
        $blockTemplate->save();
        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = $paragraphBlock->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 4;
        $blockTemplate->save();
        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = $ctaBlock->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 5;
        $blockTemplate->save();

        $page = new Page();
        $page->language_id = $language->id;
        $page->template_id = $template->id;
        $page->title = 'Textpagina';
        $page->url = 'textpagina';
        $page->save();
        $page->refresh();

        $this->createParagraphs($template, $language, $page);
        $this->createCta($template, $language, $page);
    }

    protected function createParagraphs(Template $template, Language $language, Page $page): void
    {
        $paragraphBlock = Block::where('resource_id', 'iws_paragraph')->first();
        $paragraphTitleBlockVariable = BlockVariable::where('name', 'title')->where('block_id', $paragraphBlock->id)->first();
        $paragraphTextBlockVariable = BlockVariable::where('name', 'text')->where('block_id', $paragraphBlock->id)->first();
        $paragraphImageBlockVariable = BlockVariable::where('name', 'image')->where('block_id', $paragraphBlock->id)->first();
        $paragraphUrlBlockVariable = BlockVariable::where('name', 'url')->where('block_id', $paragraphBlock->id)->first();
        $paragraphUrlTextBlockVariable = BlockVariable::where('name', 'url_text')->where('block_id', $paragraphBlock->id)->first();
        $paragraphImagePositionBlockVariable = BlockVariable::where('name', 'image_position')->where('block_id', $paragraphBlock->id)->first();
        $baseParagraphTemplateBlock1 = BlockTemplate::where('block_id', $paragraphBlock->id)
                                                    ->where('template_id', $template->id)
                                                    ->where('ordering', 1)
                                                    ->first();
        $baseParagraphTemplateBlock2 = BlockTemplate::where('block_id', $paragraphBlock->id)
                                                    ->where('template_id', $template->id)
                                                    ->where('ordering', 2)
                                                    ->first();
        $baseParagraphTemplateBlock3 = BlockTemplate::where('block_id', $paragraphBlock->id)
                                                    ->where('template_id', $template->id)
                                                    ->where('ordering', 3)
                                                    ->first();
        $baseParagraphTemplateBlock4 = BlockTemplate::where('block_id', $paragraphBlock->id)
                                                    ->where('template_id', $template->id)
                                                    ->where('ordering', 4)
                                                    ->first();
        $this->createParagraphBlockVariableValues(
            '',
            '',
            '',
            '',
            $paragraphTitleBlockVariable,
            $paragraphTextBlockVariable,
            $paragraphImageBlockVariable,
            $paragraphUrlBlockVariable,
            $paragraphUrlTextBlockVariable,
            $paragraphImagePositionBlockVariable,
            $baseParagraphTemplateBlock1,
            $language,
            $page
        );
        $this->createParagraphBlockVariableValues(
            'images/placeholder.jpg',
            'https://google.com',
            'Lees meer',
            'left',
            $paragraphTitleBlockVariable,
            $paragraphTextBlockVariable,
            $paragraphImageBlockVariable,
            $paragraphUrlBlockVariable,
            $paragraphUrlTextBlockVariable,
            $paragraphImagePositionBlockVariable,
            $baseParagraphTemplateBlock2,
            $language,
            $page
        );
        $this->createParagraphBlockVariableValues(
            '',
            '',
            '',
            '',
            $paragraphTitleBlockVariable,
            $paragraphTextBlockVariable,
            $paragraphImageBlockVariable,
            $paragraphUrlBlockVariable,
            $paragraphUrlTextBlockVariable,
            $paragraphImagePositionBlockVariable,
            $baseParagraphTemplateBlock3,
            $language,
            $page
        );
        $this->createParagraphBlockVariableValues(
            'images/placeholder.jpg',
            '',
            '',
            'right',
            $paragraphTitleBlockVariable,
            $paragraphTextBlockVariable,
            $paragraphImageBlockVariable,
            $paragraphUrlBlockVariable,
            $paragraphUrlTextBlockVariable,
            $paragraphImagePositionBlockVariable,
            $baseParagraphTemplateBlock4,
            $language,
            $page
        );
    }

    protected function createParagraphBlockVariableValues(
        string $image,
        string $url,
        string $urlText,
        string $imagePosition,
        BlockVariable $paragraphTitleBlockVariable,
        BlockVariable $paragraphTextBlockVariable,
        BlockVariable $paragraphImageBlockVariable,
        BlockVariable $paragraphUrlBlockVariable,
        BlockVariable $paragraphUrlTextBlockVariable,
        BlockVariable $paragraphImagePositionBlockVariable,
        BlockTemplate $baseParagraphTemplateBlock,
        Language $language,
        Page $page
    ): void {
        $title = 'Lorem ipsum dolor sit amet';
        $text = 'Consectetur adipiscing elit. Proin ut magna et nibh dictum dignissim. Curabitur imperdiet tellus ac dolor dictum consequat. Morbi placerat mauris ac eros tincidunt, ut tristique sem ornare. Cras vitae libero dolor. Vestibulum blandit dapibus mi, in aliquam metus. Nulla tristique fermentum massa a interdum. Nullam lectus quam, hendrerit sollicitudin aliquet vitae, luctus sollicitudin massa. Nullam et volutpat lacus. Nam faucibus lorem mauris, vitae ornare ligula maximus facilisis.';

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphTitleBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock->id;
        $blockVariableValue->value = $title;
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphTextBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock->id;
        $blockVariableValue->value = $text;
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphImageBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock->id;
        $blockVariableValue->value = $image;
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphUrlBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock->id;
        $blockVariableValue->value = $url;
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphUrlTextBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock->id;
        $blockVariableValue->value = $urlText;
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphImagePositionBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock->id;
        $blockVariableValue->value = $imagePosition;
        $blockVariableValue->save();
    }

    protected function createCta(Template $template, Language $language, Page $page): void
    {
        $ctaBlock = Block::where('resource_id', 'iws_cta')->first();
        $ctaTitleBlockVariable = BlockVariable::where('name', 'title')->where('block_id', $ctaBlock->id)->first();
        $ctaTextBlockVariable = BlockVariable::where('name', 'text')->where('block_id', $ctaBlock->id)->first();
        $ctaImageBlockVariable = BlockVariable::where('name', 'image')->where('block_id', $ctaBlock->id)->first();
        $ctaNameBlockVariable = BlockVariable::where('name', 'name')->where('block_id', $ctaBlock->id)->first();
        $ctaFunctionBlockVariable = BlockVariable::where('name', 'function')->where('block_id', $ctaBlock->id)->first();
        $ctaPhoneBlockVariable = BlockVariable::where('name', 'phone_number')->where('block_id', $ctaBlock->id)->first();
        $ctaEmailBlockVariable = BlockVariable::where('name', 'email')->where('block_id', $ctaBlock->id)->first();
        $ctaUrlBlockVariable = BlockVariable::where('name', 'url')->where('block_id', $ctaBlock->id)->first();
        $ctaUrlTextBlockVariable = BlockVariable::where('name', 'url_text')->where('block_id', $ctaBlock->id)->first();
        $baseCtaTemplateBlock = BlockTemplate::where('block_id', $ctaBlock->id)->where('template_id', $template->id)->first();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $ctaTitleBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseCtaTemplateBlock->id;
        $blockVariableValue->value = 'Lorem ipsum dolor sit amet';
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $ctaTextBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseCtaTemplateBlock->id;
        $blockVariableValue->value = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ut magna et nibh.';
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $ctaImageBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseCtaTemplateBlock->id;
        $blockVariableValue->value = 'images/placeholder.jpg';
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $ctaNameBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseCtaTemplateBlock->id;
        $blockVariableValue->value = 'Linda Vishers';
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $ctaFunctionBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseCtaTemplateBlock->id;
        $blockVariableValue->value = 'CEO';
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $ctaPhoneBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseCtaTemplateBlock->id;
        $blockVariableValue->value = '06 12 34 56 78';
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $ctaEmailBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseCtaTemplateBlock->id;
        $blockVariableValue->value = 'linda@musthaves4u.nl';
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $ctaUrlBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseCtaTemplateBlock->id;
        $blockVariableValue->value = '/contact';
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $ctaUrlTextBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseCtaTemplateBlock->id;
        $blockVariableValue->value = 'Neem contact op';
        $blockVariableValue->save();
    }
}
