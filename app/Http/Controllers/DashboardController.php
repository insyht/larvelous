<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(): Renderable
    {
        return view('dashboard.home');
    }
}
