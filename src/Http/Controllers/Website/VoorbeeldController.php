<?php

namespace Insyht\Larvelous\Http\Controllers\Website;

use Illuminate\Routing\Controller;

class VoorbeeldController extends Controller
{
    public function categorie()
    {
        return view('templates.categorie');
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
