<?php

namespace Insyht\Larvelous\Database\Seeders\Pages;

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
        $template->view = 'insyht-larvelous::base';
        $template->save();
        $template->refresh();

        $page = new Page();
        $page->language_id = $language->id;
        $page->template_id = $template->id;
        $page->title = 'Textpagina';
        $page->url = 'textpagina';
        $page->save();
    }
}
