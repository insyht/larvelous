<?php

namespace Insyht\Larvelous\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class PluginController extends Controller
{
    public function index(): Renderable
    {
        return view('dashboard.plugins.home');
    }
}
