<?php

namespace Database\Seeders;

use App\Forms\Components\Dropdown;
use App\Forms\Components\ExistingImageUpload;
use App\Models\BlockVariableType;
use App\Models\Language;
use App\Models\Menu;
use App\Forms\Components\Textarea;
use App\Forms\Components\TextInput;
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

        $blockVariableTypeTextfield = new BlockVariableType();
        $blockVariableTypeTextfield->name = BlockVariableType::TYPE_TEXTFIELD;
        $blockVariableTypeTextfield->fqn = TextInput::class;
        $blockVariableTypeTextfield->save();

        $blockVariableTypeTextarea = new BlockVariableType();
        $blockVariableTypeTextarea->name = BlockVariableType::TYPE_TEXTAREA;
        $blockVariableTypeTextfield->fqn = Textarea::class;
        $blockVariableTypeTextarea->save();

        $blockVariableTypeImage = new BlockVariableType();
        $blockVariableTypeImage->name = BlockVariableType::TYPE_IMAGE;
        $blockVariableTypeTextfield->fqn = ExistingImageUpload::class;
        $blockVariableTypeImage->save();

        $blockVariableTypeDropdown = new BlockVariableType();
        $blockVariableTypeDropdown->name = BlockVariableType::TYPE_DROPDOWN;
        $blockVariableTypeTextfield->fqn = Dropdown::class;
        $blockVariableTypeDropdown->save();
    }
}
