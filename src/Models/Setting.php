<?php

namespace Insyht\Larvelous\Models;

use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasEvents;

    public const COLOR_PRIMARY = 'larvelous-color-primary';
    public const COLOR_PRIMARY_TEXT = 'larvelous-color-primary-text';
    public const COLOR_PRIMARY_LIGHT = 'larvelous-color-primary-light';
    public const COLOR_SECONDARY = 'larvelous-color-secondary';
    public const COLOR_SECONDARY_TEXT = 'larvelous-color-secondary-text';
    public const COLOR_SECONDARY_LIGHT = 'larvelous-color-secondary-light';
    public const COLOR_TERTIARY = 'larvelous-color-tertiary';
    public const COLOR_TERTIARY_TEXT = 'larvelous-color-tertiary-text';
    public const COLOR_TERTIARY_LIGHT = 'larvelous-color-tertiary-light';
    public const COLOR_BLACK = 'larvelous-color-black';
    public const COLOR_WHITE = 'larvelous-color-white';

    public const CUSTOM_COLORS_PATH = __DIR__ . '/../../resources/sass/custom/_colors.scss';

    public $timestamps = false;

    protected $fillable = ['name', 'value'];
}










