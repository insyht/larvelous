<?php

namespace Database\Seeders;

use App\Language;
use App\Menu;
use App\Page;
use App\Template;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    public function run()
    {
        $language = new Language();
        $language->name = 'Nederlands';
        $language->abbreviation = 'nl';
        $language->save();
        $language->refresh();

        $topMenu = new Menu();
        $topMenu->language_id = $language->id;
        $topMenu->name = 'Hoofdmenu';
        $topMenu->position = 'main_menu';
        $topMenu->save();

        $footerMenu = new Menu();
        $footerMenu->language_id = $language->id;
        $footerMenu->name = 'Footer menu';
        $footerMenu->position = 'footer_menu';
        $footerMenu->save();

        $template = new Template();
        $template->resource_id = 'iws_home';
        $template->label = 'Homepage';
        $template->view = 'iws/resources/views/home';
        $template->save();
        $template->refresh();

        $page = new Page();
        $page->language_id = $language->id;
        $page->template_id = $template->id;
        $page->title = 'Home';
        $page->url = '';
        $page->save();
    }
}
