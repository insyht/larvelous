<?php

namespace Insyht\Larvelous\Database\Seeders\Home;

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
        $page = Page::where('title', 'Home')->first();

        $paragraphBlock = Block::where('resource_id', 'iws_paragraph')->first();
        $imageAttentionBlock = Block::where('resource_id', 'iws_image_attention')->first();
        $newsletterBlock = Block::where('resource_id', 'iws_newsletter')->first();
        $ctaBlock = Block::where('resource_id', 'iws_cta')->first();

        $paragraphTitleBlockVariable = BlockVariable::where('name', 'title')
                                                    ->where('block_id', $paragraphBlock->id)
                                                    ->first();
        $paragraphTextBlockVariable = BlockVariable::where('name', 'text')
                                                    ->where('block_id', $paragraphBlock->id)
                                                    ->first();
        $paragraphImageBlockVariable = BlockVariable::where('name', 'image')
                                                    ->where('block_id', $paragraphBlock->id)
                                                    ->first();
        $paragraphUrlBlockVariable = BlockVariable::where('name', 'url')
                                                  ->where('block_id', $paragraphBlock->id)
                                                  ->first();
        $paragraphUrlTextBlockVariable = BlockVariable::where('name', 'url_text')
                                                      ->where('block_id', $paragraphBlock->id)
                                                      ->first();
        $paragraphImagePositionBlockVariable1 = BlockVariable::where('name', 'image_position')
                                                             ->where('block_id', $paragraphBlock->id)
                                                             ->first();

        $attentionImageLeftBlockVariable = BlockVariable::where('name', 'image_left')
                                                        ->where('block_id', $imageAttentionBlock->id)
                                                        ->first();
        $attentionImageRightTopBlockVariable = BlockVariable::where('name', 'image_right_top')
                                                            ->where('block_id', $imageAttentionBlock->id)
                                                            ->first();
        $attentionImageRightBottomBlockVariable = BlockVariable::where('name', 'image_right_bottom')
                                                               ->where('block_id', $imageAttentionBlock->id)
                                                               ->first();

        $newsletterImageLeftBlockVariable = BlockVariable::where('name', 'image_left')
                                                         ->where('block_id', $newsletterBlock->id)
                                                         ->first();
        $newsletterTitleBlockVariable = BlockVariable::where('name', 'title')
                                                     ->where('block_id', $newsletterBlock->id)
                                                     ->first();
        $newsletterTextBlockVariable = BlockVariable::where('name', 'text')
                                                    ->where('block_id', $newsletterBlock->id)
                                                    ->first();
        $newsletterImageRightBlockVariable = BlockVariable::where('name', 'image_right')
                                                          ->where('block_id', $newsletterBlock->id)
                                                          ->first();

        $ctaTitleBlockVariable = BlockVariable::where('name', 'title')->where('block_id', $ctaBlock->id)->first();
        $ctaTextBlockVariable = BlockVariable::where('name', 'text')->where('block_id', $ctaBlock->id)->first();
        $ctaImageBlockVariable = BlockVariable::where('name', 'image')->where('block_id', $ctaBlock->id)->first();
        $ctaNameBlockVariable = BlockVariable::where('name', 'name')->where('block_id', $ctaBlock->id)->first();
        $ctaFunctionBlockVariable = BlockVariable::where('name', 'function')->where('block_id', $ctaBlock->id)->first();
        $ctaPhoneBlockVariable = BlockVariable::where('name', 'phone_number')->where('block_id', $ctaBlock->id)->first();
        $ctaEmailBlockVariable = BlockVariable::where('name', 'email')->where('block_id', $ctaBlock->id)->first();
        $ctaUrlBlockVariable = BlockVariable::where('name', 'url')->where('block_id', $ctaBlock->id)->first();
        $ctaUrlTextBlockVariable = BlockVariable::where('name', 'url_text')->where('block_id', $ctaBlock->id)->first();

        $template = Template::where('resource_id', 'iws_home')->first();
        $baseParagraphTemplateBlock1 = BlockTemplate::where('block_id', $paragraphBlock->id)
                                              ->where('template_id', $template->id)
                                              ->where('ordering', 2)
                                              ->first();
        $baseParagraphTemplateBlock2 = BlockTemplate::where('block_id', $paragraphBlock->id)
                                              ->where('template_id', $template->id)
                                              ->where('ordering', 3)
                                              ->first();
        $baseParagraphTemplateBlock3 = BlockTemplate::where('block_id', $paragraphBlock->id)
                                              ->where('template_id', $template->id)
                                              ->where('ordering', 4)
                                              ->first();
        $baseParagraphTemplateBlock4 = BlockTemplate::where('block_id', $paragraphBlock->id)
                                              ->where('template_id', $template->id)
                                              ->where('ordering', 5)
                                              ->first();
        $baseImageAttentionTemplateBlock = BlockTemplate::where('block_id', $imageAttentionBlock->id)
                                              ->where('template_id', $template->id)
                                              ->first();
        $baseNewsletterTemplateBlock = BlockTemplate::where('block_id', $newsletterBlock->id)
                                              ->where('template_id', $template->id)
                                              ->first();
        $baseCtaTemplateBlock = BlockTemplate::where('block_id', $ctaBlock->id)
                                              ->where('template_id', $template->id)
                                              ->first();


        // First paragraph
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphTitleBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock1->id;
        $blockVariableValue->value = 'Lorem ipsum dolor sit amet';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphTextBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock1->id;
        $blockVariableValue->value = 'Consectetur adipiscing elit. Proin ut magna et nibh dictum dignissim. Curabitur imperdiet tellus ac dolor dictum consequat. Morbi placerat mauris ac eros tincidunt, ut tristique sem ornare. Cras vitae libero dolor. Vestibulum blandit dapibus mi, in aliquam metus. Nulla tristique fermentum massa a interdum. Nullam lectus quam, hendrerit sollicitudin aliquet vitae, luctus sollicitudin massa. Nullam et volutpat lacus. Nam faucibus lorem mauris, vitae ornare ligula maximus facilisis.';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphImageBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock1->id;
        $blockVariableValue->value = 'images/placeholder.jpg';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue(); // id=18
        $blockVariableValue->block_variable_id = $paragraphImagePositionBlockVariable1->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock1->id;
        $blockVariableValue->value = 'left';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphUrlBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock1->id;
        $blockVariableValue->value = '/home';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphUrlTextBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock1->id;
        $blockVariableValue->value = 'Lees meer';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        // Second paragraph
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphTitleBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock2->id;
        $blockVariableValue->value = 'Lorem ipsum dolor sit amet';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphTextBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock2->id;
        $blockVariableValue->value = 'Consectetur adipiscing elit. Proin ut magna et nibh dictum dignissim. Curabitur imperdiet tellus ac dolor dictum consequat. Morbi placerat mauris ac eros tincidunt, ut tristique sem ornare. Cras vitae libero dolor. Vestibulum blandit dapibus mi, in aliquam metus. Nulla tristique fermentum massa a interdum. Nullam lectus quam, hendrerit sollicitudin aliquet vitae, luctus sollicitudin massa. Nullam et volutpat lacus. Nam faucibus lorem mauris, vitae ornare ligula maximus facilisis.';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphImageBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock2->id;
        $blockVariableValue->value = 'images/placeholder.jpg';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue(); // id=21
        $blockVariableValue->block_variable_id = $paragraphImagePositionBlockVariable1->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock2->id;
        $blockVariableValue->value = 'right';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        // Third paragraph
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphTitleBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock3->id;
        $blockVariableValue->value = 'Lorem ipsum dolor sit amet';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphTextBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock3->id;
        $blockVariableValue->value = 'Consectetur adipiscing elit. Proin ut magna et nibh dictum dignissim. Curabitur imperdiet tellus ac dolor dictum consequat. Morbi placerat mauris ac eros tincidunt, ut tristique sem ornare. Cras vitae libero dolor. Vestibulum blandit dapibus mi, in aliquam metus. Nulla tristique fermentum massa a interdum. Nullam lectus quam, hendrerit sollicitudin aliquet vitae, luctus sollicitudin massa. Nullam et volutpat lacus. Nam faucibus lorem mauris, vitae ornare ligula maximus facilisis.';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        // Fourth paragraph
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphTitleBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock4->id;
        $blockVariableValue->value = 'Lorem ipsum dolor sit amet';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $paragraphTextBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseParagraphTemplateBlock4->id;
        $blockVariableValue->value = 'Consectetur adipiscing elit. Proin ut magna et nibh dictum dignissim. Curabitur imperdiet tellus ac dolor dictum consequat. Morbi placerat mauris ac eros tincidunt, ut tristique sem ornare. Cras vitae libero dolor. Vestibulum blandit dapibus mi, in aliquam metus. Nulla tristique fermentum massa a interdum. Nullam lectus quam, hendrerit sollicitudin aliquet vitae, luctus sollicitudin massa. Nullam et volutpat lacus. Nam faucibus lorem mauris, vitae ornare ligula maximus facilisis.';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        // Image attention
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $attentionImageLeftBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseImageAttentionTemplateBlock->id;
        $blockVariableValue->value = 'images/placeholder.jpg';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $attentionImageRightTopBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseImageAttentionTemplateBlock->id;
        $blockVariableValue->value = 'images/placeholder.jpg';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $attentionImageRightBottomBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseImageAttentionTemplateBlock->id;
        $blockVariableValue->value = 'images/placeholder.jpg';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        // Newsletter
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $newsletterImageLeftBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseNewsletterTemplateBlock->id;
        $blockVariableValue->value = 'images/placeholder.jpg';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $newsletterTitleBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseNewsletterTemplateBlock->id;
        $blockVariableValue->value = 'Aanmelden nieuwsbrief';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $newsletterTextBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseNewsletterTemplateBlock->id;
        $blockVariableValue->value = 'Voor info over de nieuwste musthaves!';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $newsletterImageRightBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseNewsletterTemplateBlock->id;
        $blockVariableValue->value = 'images/placeholder.jpg';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        // CTA
        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $ctaTitleBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseCtaTemplateBlock->id;
        $blockVariableValue->value = 'Lorem ipsum dolor sit amet';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $ctaTextBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseCtaTemplateBlock->id;
        $blockVariableValue->value = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ut magna et nibh.';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $ctaImageBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseCtaTemplateBlock->id;
        $blockVariableValue->value = 'images/placeholder.jpg';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $ctaNameBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseCtaTemplateBlock->id;
        $blockVariableValue->value = 'Linda Vishers';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $ctaFunctionBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseCtaTemplateBlock->id;
        $blockVariableValue->value = 'CEO';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $ctaPhoneBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseCtaTemplateBlock->id;
        $blockVariableValue->value = '06 12 34 56 78';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $ctaEmailBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseCtaTemplateBlock->id;
        $blockVariableValue->value = 'linda@musthaves4u.nl';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $ctaUrlBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseCtaTemplateBlock->id;
        $blockVariableValue->value = '/contact';
        $blockVariableValue->save();
        $blockVariableValue->refresh();

        $blockVariableValue = new BlockVariableValue();
        $blockVariableValue->block_variable_id = $ctaUrlTextBlockVariable->id;
        $blockVariableValue->language_id = $language->id;
        $blockVariableValue->page_id = $page->id;
        $blockVariableValue->block_template_id = $baseCtaTemplateBlock->id;
        $blockVariableValue->value = 'Neem contact op';
        $blockVariableValue->save();
        $blockVariableValue->refresh();
    }
}
