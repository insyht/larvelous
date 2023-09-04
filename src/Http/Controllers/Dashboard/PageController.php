<?php

namespace Insyht\Larvelous\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(): Renderable
    {
        return view('dashboard.pages.home');
    }
}
