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

class LandingPageSeeder extends Seeder
{
    public function run()
    {
        $language = Language::where('name', 'Nederlands')->first();
        $template = Template::where('resource_id', 'iws_landing_page')->first();
        $page = Page::where('template_id', $template->id)->first();

        $this->createHeader($template, $language, $page);
        $this->createTetralogy($template, $language, $page);
        $this->createTitleAndText($template, $language, $page);
        $this->createUsps($template, $language, $page);
        $this->createParagraphs($template, $language, $page);
        $this->createCta($template, $language, $page);
    }

    protected function createHeader(Template $template, Language $language, Page $page): void
    {
        $headerBlock = Block::where('resource_id', 'iws_landing_page_header')->first();
        $headerTitleBlockVariable = BlockVariable::where('name', 'title')->where('block_id', $headerBlock->id)->first();
        $headerSubtitleBlockVariable = BlockVariable::where('name', 'subtitle')->where('block_id', $headerBlock->id)->first();
        $headerTextBlockVariable = BlockVariable::where('name', 'text')->where('block_id', $headerBlock->id)->first();
        $headerQuoteBlockVariable = BlockVariable::where('name', 'quote')->where('block_id', $headerBlock->id)->first();
        $headerQuoteNameBlockVariable = BlockVariable::where('name', 'quote_name')->where('block_id', $headerBlock->id)->first();
        $headerQuoteCityBlockVariable = BlockVariable::where('name', 'quote_city')->where('block_id', $headerBlock->id)->first();
        $headerUrlBlockVariable = BlockVariable::where('name', 'url')->where('block_id', $headerBlock->id)->first();
        $headerUrlTextBlockVariable = BlockVariable::where('name', 'url_text')->where('block_id', $headerBlock->id)->first();
        $headerImageBlockVariable = BlockVariable::where('name', 'image')->where('block_id', $headerBlock->id)->first();
        $baseHeaderTemplateBlock = BlockTemplate::where('block_id', $headerBlock->id)->where('template_id', $template->id)->first();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $headerTitleBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'De beste kralen, de mooiste kleuren';
        $blockVariableValue->block_template_id = $baseHeaderTemplateBlock->id;
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $headerSubtitleBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'Kies uit onze modellen of stel zelf samen';
        $blockVariableValue->block_template_id = $baseHeaderTemplateBlock->id;
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $headerTextBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sagittis egestas vestibulum. Praesent vulputate dolor tortor, eu viverra sapien interdum at. Ut sit amet sem leo. Donec et mauris tellus. Praesent ut consequat nunc. Morbi venenatis non lacus non rhoncus. Duis eu lectus sed felis consequat tempor. In eget rhoncus neque, sit amet bibendum urna.';
        $blockVariableValue->block_template_id = $baseHeaderTemplateBlock->id;
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $headerQuoteBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'Het perfecte kraamcadeau voor de kleine meid van mijn beste vriendin!';
        $blockVariableValue->block_template_id = $baseHeaderTemplateBlock->id;
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $headerQuoteNameBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'Linda Vishers';
        $blockVariableValue->block_template_id = $baseHeaderTemplateBlock->id;
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $headerQuoteCityBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'Made';
        $blockVariableValue->block_template_id = $baseHeaderTemplateBlock->id;
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $headerUrlBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = '/categorie';
        $blockVariableValue->block_template_id = $baseHeaderTemplateBlock->id;
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $headerUrlTextBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'Bekijk de collectie';
        $blockVariableValue->block_template_id = $baseHeaderTemplateBlock->id;
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $headerImageBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'images/header.jpg';
        $blockVariableValue->block_template_id = $baseHeaderTemplateBlock->id;
        $blockVariableValue->save();
    }

    protected function createTetralogy(Template $template, Language $language, Page $page): void
    {
        $tetralogyBlock = Block::where('resource_id', 'iws_image_tetralogy')->first();
        $tetralogyTitleBlockVariable = BlockVariable::where('name', 'title')->where('block_id', $tetralogyBlock->id)->first();
        $tetralogyImageBlockVariable1 = BlockVariable::where('name', 'image')->where('block_id', $tetralogyBlock->id)->where('ordering', 2)->first();
        $tetralogyImageBlockVariable2 = BlockVariable::where('name', 'image')->where('block_id', $tetralogyBlock->id)->where('ordering', 3)->first();
        $tetralogyImageBlockVariable3 = BlockVariable::where('name', 'image')->where('block_id', $tetralogyBlock->id)->where('ordering', 4)->first();
        $tetralogyImageBlockVariable4 = BlockVariable::where('name', 'image')->where('block_id', $tetralogyBlock->id)->where('ordering', 5)->first();
        $baseTetralogyTemplateBlock = BlockTemplate::where('block_id', $tetralogyBlock->id)->where('template_id', $template->id)->first();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $tetralogyTitleBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'Wij verkopen alleen merken van de hoogste kwaliteit';
        $blockVariableValue->block_template_id = $baseTetralogyTemplateBlock->id;
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $tetralogyImageBlockVariable1->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'images/placeholder.jpg';
        $blockVariableValue->block_template_id = $baseTetralogyTemplateBlock->id;
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $tetralogyImageBlockVariable2->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'images/placeholder.jpg';
        $blockVariableValue->block_template_id = $baseTetralogyTemplateBlock->id;
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $tetralogyImageBlockVariable3->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'images/placeholder.jpg';
        $blockVariableValue->block_template_id = $baseTetralogyTemplateBlock->id;
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $tetralogyImageBlockVariable4->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'images/placeholder.jpg';
        $blockVariableValue->block_template_id = $baseTetralogyTemplateBlock->id;
        $blockVariableValue->save();
    }

    protected function createTitleAndText(Template $template, Language $language, Page $page): void
    {
        $titleTextBlock = Block::where('resource_id', 'iws_title_text')->first();
        $titleTextTitleBlockVariable = BlockVariable::where('name', 'title')->where('block_id', $titleTextBlock->id)->first();
        $titleTextTextBlockVariable = BlockVariable::where('name', 'text')->where('block_id', $titleTextBlock->id)->first();
        $baseTitleTextTemplateBlock = BlockTemplate::where('block_id', $titleTextBlock->id)->where('template_id', $template->id)->first();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $titleTextTitleBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'Waarom Musthaves4u?';
        $blockVariableValue->block_template_id = $baseTitleTextTemplateBlock->id;
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $titleTextTextBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sagittis egestas vestibulum. Praesent vulputate dolor tortor, eu viverra sapien interdum at. Ut sit amet sem leo. Donec et mauris tellus.';
        $blockVariableValue->block_template_id = $baseTitleTextTemplateBlock->id;
        $blockVariableValue->save();
    }

    protected function createUsps(Template $template, Language $language, Page $page): void
    {
        $uspsBlock = Block::where('resource_id', 'iws_usps')->first();
        $uspsIconBlockVariable1 = BlockVariable::where('name', 'icon')->where('block_id', $uspsBlock->id)->where('ordering', 1)->first();
        $uspsTitleBlockVariable1 = BlockVariable::where('name', 'title')->where('block_id', $uspsBlock->id)->where('ordering', 2)->first();
        $uspsTextBlockVariable1 = BlockVariable::where('name', 'text')->where('block_id', $uspsBlock->id)->where('ordering', 3)->first();
        $uspsIconBlockVariable2 = BlockVariable::where('name', 'icon')->where('block_id', $uspsBlock->id)->where('ordering', 4)->first();
        $uspsTitleBlockVariable2 = BlockVariable::where('name', 'title')->where('block_id', $uspsBlock->id)->where('ordering', 5)->first();
        $uspsTextBlockVariable2 = BlockVariable::where('name', 'text')->where('block_id', $uspsBlock->id)->where('ordering', 6)->first();
        $uspsIconBlockVariable3 = BlockVariable::where('name', 'icon')->where('block_id', $uspsBlock->id)->where('ordering', 7)->first();
        $uspsTitleBlockVariable3 = BlockVariable::where('name', 'title')->where('block_id', $uspsBlock->id)->where('ordering', 8)->first();
        $uspsTextBlockVariable3 = BlockVariable::where('name', 'text')->where('block_id', $uspsBlock->id)->where('ordering', 9)->first();
        $baseUspsTemplateBlock = BlockTemplate::where('block_id', $uspsBlock->id)->where('template_id', $template->id)->first();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $uspsIconBlockVariable1->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'bi bi-card-checklist';
        $blockVariableValue->block_template_id = $baseUspsTemplateBlock->id;
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $uspsTitleBlockVariable1->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'Uitgebreid getest';
        $blockVariableValue->block_template_id = $baseUspsTemplateBlock->id;
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $uspsTextBlockVariable1->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'Onze producten worden constant getest en we hebben de certificaten om het te bewijzen.';
        $blockVariableValue->block_template_id = $baseUspsTemplateBlock->id;
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $uspsIconBlockVariable2->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'bi bi-piggy-bank';
        $blockVariableValue->block_template_id = $baseUspsTemplateBlock->id;
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $uspsTitleBlockVariable2->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'Tevredenheidsgarantie';
        $blockVariableValue->block_template_id = $baseUspsTemplateBlock->id;
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $uspsTextBlockVariable2->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'Bevalt een product niet 100%? Je kunt het binnen 30 dagen terugsturen en je geld terug krijgen.';
        $blockVariableValue->block_template_id = $baseUspsTemplateBlock->id;
        $blockVariableValue->save();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $uspsIconBlockVariable3->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'bi bi-toggles2';
        $blockVariableValue->block_template_id = $baseUspsTemplateBlock->id;
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $uspsTitleBlockVariable3->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'Honderden opties';
        $blockVariableValue->block_template_id = $baseUspsTemplateBlock->id;
        $blockVariableValue->save();
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $uspsTextBlockVariable3->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->value = 'Honderden kralen in alle kleuren van de regenboog, dus voor ieder wat wils.';
        $blockVariableValue->block_template_id = $baseUspsTemplateBlock->id;
        $blockVariableValue->save();
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
                                                    ->where('ordering', 6)
                                                    ->first();
        $baseParagraphTemplateBlock2 = BlockTemplate::where('block_id', $paragraphBlock->id)
                                                    ->where('template_id', $template->id)
                                                    ->where('ordering', 7)
                                                    ->first();
        $baseParagraphTemplateBlock3 = BlockTemplate::where('block_id', $paragraphBlock->id)
                                                    ->where('template_id', $template->id)
                                                    ->where('ordering', 8)
                                                    ->first();
        $baseParagraphTemplateBlock4 = BlockTemplate::where('block_id', $paragraphBlock->id)
                                                    ->where('template_id', $template->id)
                                                    ->where('ordering', 9)
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
