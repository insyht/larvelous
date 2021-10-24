<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(): Renderable
    {
        return view('dashboard.settings.home');
    }
}
