<?php

namespace App\Filament;

use App\Forms\Components\Hidden;
use App\Models\Language;
use Filament\Forms\Components\Field;

class LanguageFormField
{
    public static function create(): Field
    {
        return Hidden::make('language_id')->default(Language::firstWhere('name', 'Nederlands')->id)->required();
    }
}
