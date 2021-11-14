@extends('layouts.website')
@section('content')
    <h1>Winkelwagen</h1>
    <div class="row d-none d-sm-flex">
        <div class="col-2"><strong>&nbsp;</strong></div>
        <div class="col-2"><strong>Product</strong></div>
        <div class="col-2"><strong>Prijs</strong></div>
        <div class="col-2"><strong>Aantal</strong></div>
        <div class="col-2"><strong>Subtotaal</strong></div>
        <div class="col-2"><strong>&nbsp;</strong></div>
    </div>
    <div class="row mb-5 mb-sm-0">
        <div class="col-6 col-sm-2 text-center text-sm-left mt-3">
            <img src="{{url('/images/placeholder.jpg')}}" class="img-fluid" alt="...">
        </div>
        <div class="col-6 col-sm-2 text-left text-sm-left mt-3">
            <p class="h4"><a href="/voorbeeld/product">Frigg speen daisy maat 2 Baked clay</a></p>
        </div>
        <div class="col-4 col-sm-2 mt-3 d-flex align-items-center justify-content-center justify-content-sm-start">
            <p class="mb-0">&euro; 4,95</p> <span class="d-inline d-sm-none">&nbsp;x</span>
        </div>
        <div class="col-4 col-sm-2 text-center text-sm-left mt-3 d-flex align-items-center justify-content-center">
            <input class="form-control" value="1" min="1" max="999" type="number" name="amount">
        </div>
        <div class="col-4 col-sm-2 mt-3 d-flex align-items-center justify-content-center justify-content-sm-start">
            <span class="d-inline d-sm-none">=&nbsp;</span><p class="mb-0"> &euro; 4,95</p>
        </div>
        <div class="col-12 col-sm-2 text-center text-sm-left mt-3 d-flex align-items-center justify-content-center">
            <button class="btn btn-secondary w-100">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    </div>

    <div class="row mt-5 mt-sm-0 mb-5 mb-sm-0">
        <div class="col-6 col-sm-2 text-center text-sm-left mt-3">
            <img src="{{url('/images/placeholder.jpg')}}" class="img-fluid" alt="...">
        </div>
        <div class="col-6 col-sm-2 text-left mt-3">
            <p class="h4"><a href="/voorbeeld/product">Frigg speen daisy maat 2 Blush</a></p>
        </div>
        <div class="col-4 col-sm-2 mt-3 d-flex align-items-center justify-content-center justify-content-sm-start">
            <p class="mb-0">&euro; 4,95</p> <span class="d-inline d-sm-none">&nbsp;x</span>
        </div>
        <div class="col-4 col-sm-2 text-center text-sm-left mt-3 d-flex align-items-center justify-content-center">
            <input class="form-control" value="3" min="1" max="999" type="number" name="amount">
        </div>
        <div class="col-4 col-sm-2 mt-3 d-flex align-items-center justify-content-center justify-content-sm-start">
            <span class="d-inline d-sm-none">=&nbsp;</span><p class="mb-0"> &euro; 14,85</p>
        </div>
        <div class="col-12 col-sm-2 text-center text-sm-left mt-3 d-flex align-items-center justify-content-center">
            <button class="btn btn-secondary w-100">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    </div>
    <div class="row mt-5 mt-sm-0">
        <div class="col-6 col-sm-2 text-center text-sm-left mt-3">
            <img src="{{url('/images/placeholder.jpg')}}" class="img-fluid" alt="...">
        </div>
        <div class="col-6 col-sm-2 text-left text-sm-left mt-3">
            <p class="h4"><a href="/voorbeeld/product">Frigg speen daisy maat 2 Cream</a></p>
        </div>
        <div class="col-4 col-sm-2 mt-3 d-flex align-items-center justify-content-center justify-content-sm-start">
            <p class="mb-0">&euro; 4,95</p> <span class="d-inline d-sm-none">&nbsp;x</span>
        </div>
        <div class="col-4 col-sm-2 text-center text-sm-left mt-3 d-flex align-items-center justify-content-center">
            <input class="form-control" value="1" min="1" max="999" type="number" name="amount">
        </div>
        <div class="col-4 col-sm-2 mt-3 d-flex align-items-center justify-content-center justify-content-sm-start">
            <span class="d-inline d-sm-none">=&nbsp;</span><p class="mb-0"> &euro; 4,95</p>
        </div>
        <div class="col-12 col-sm-2 text-center text-sm-left mt-3 d-flex align-items-center justify-content-center">
            <button class="btn btn-secondary w-100">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    </div>

{{--    Todo: kortingscode, winkelmand bijwerken, subtotaal, verzendmethode?, totaal, doorgaan--}}
@endsection
