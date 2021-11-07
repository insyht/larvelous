<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VoorbeeldController extends Controller
{
    public function categorie()
    {
        return view('templates.categorie');
    }
    public function subcategorie()
    {
        return view('templates.subcategorie');
    }
    public function product()
    {
        return view('templates.product');
    }
    public function winkelwagen()
    {
        return view('templates.winkelwagen');
    }
    public function klantgegevens()
    {
        return view('templates.klantgegevens');
    }
    public function betaling()
    {
        return view('templates.betaling');
    }
    public function bevestiging()
    {
        return view('templates.bevestiging');
    }
    public function textpagina()
    {
        return view('templates.textpagina');
    }
    public function landingspagina()
    {
        return view('templates.landingspagina');
    }
    public function contact()
    {
        return view('templates.contact');
    }
}
