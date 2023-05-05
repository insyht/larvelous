<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Menu;
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
    }
}
