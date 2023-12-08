<?php

namespace Insyht\Larvelous\Database\Seeders;

use Insyht\Larvelous\Models\Language;
use Insyht\Larvelous\Models\Menu;
use Illuminate\Database\Seeder;
use Insyht\Larvelous\Models\MenuItem;
use Insyht\Larvelous\Models\Page;

class CmsSeeder extends Seeder
{
    public function run()
    {
        $language = Language::where('abbreviation', 'nl')->first();

        $homepage = Page::where('title', 'Home')->first();

        $topMenu = new Menu();
        $topMenu->language_id = $language->id;
        $topMenu->name = 'Hoofdmenu';
        $topMenu->position = 'main_menu';
        $topMenu->save();
        $topMenu->refresh();

        $item = new MenuItem();
        $item->item_id = $homepage->id;
        $item->item_type = substr(Page::class, 1); // todo Is dit met of zonder beginnende backslash?
        $item->ordering = 1;
        $topMenu->items()->save($item);

        $footerMenu = new Menu();
        $footerMenu->language_id = $language->id;
        $footerMenu->name = 'Footer menu';
        $footerMenu->position = 'footer_menu';
        $footerMenu->save();
        $footerMenu->refresh();

        $item = new MenuItem();
        $item->item_id = $homepage->id;
        $item->item_type = substr(Page::class, 1); // todo Is dit met of zonder beginnende backslash?
        $item->ordering = 1;
        $footerMenu->items()->save($item);
    }
}
