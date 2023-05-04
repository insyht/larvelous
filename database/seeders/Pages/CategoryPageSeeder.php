<?php

namespace Database\Seeders\Pages;

use App\Language;
use App\Page;
use App\Template;
use Illuminate\Database\Seeder;

class CategoryPageSeeder extends Seeder
{
    public function run()
    {
        $language = Language::where('name', 'Nederlands')->first();

        $template = new Template();
        $template->resource_id = 'iws_category';
        $template->label = 'Category template';
        $template->view = 'base';
        $template->save();
        $template->refresh();

        $page = new Page();
        $page->language_id = $language->id;
        $page->template_id = $template->id;
        $page->title = 'Categorie';
        $page->url = 'categorie';
        $page->save();
    }
}
