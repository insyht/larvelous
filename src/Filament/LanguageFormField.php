<?php

namespace Insyht\Larvelous\Filament;

use Insyht\Larvelous\Forms\Components\Hidden;
use Insyht\Larvelous\Models\Language;
use Filament\Forms\Components\Field;

class LanguageFormField
{
    public static function create(): Field
    {
        return Hidden::make('language_id')->default(Language::firstWhere('name', 'Nederlands')->id)->required();
    }
}
