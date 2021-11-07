<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index(): Renderable
    {
        return view('dashboard.templates.home');
    }
}
