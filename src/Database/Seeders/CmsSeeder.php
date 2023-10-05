<?php

namespace Insyht\Larvelous\Database\Seeders;

use Insyht\Larvelous\Forms\Components\Dropdown;
use Insyht\Larvelous\Forms\Components\ExistingImageUpload;
use Insyht\Larvelous\Models\BlockVariableType;
use Insyht\Larvelous\Models\Language;
use Insyht\Larvelous\Models\Menu;
use Insyht\Larvelous\Forms\Components\Textarea;
use Insyht\Larvelous\Forms\Components\TextInput;
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
