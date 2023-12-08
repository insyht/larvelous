<?php

namespace Insyht\Larvelous\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

interface BasePluginControllerInterface
{
    public function match(string $slug): bool;
    public function load(string $slug): Factory|View|null;
}
