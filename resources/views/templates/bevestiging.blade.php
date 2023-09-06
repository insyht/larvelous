@extends('insyht-larvelous::layouts.website')
@section('content')
    <h1>Bestelling geplaatst!</h1>
    <div class="row">
        <!-- https://www.musthaves4u.nl/checkout/order-received/5302/?key=wc_order_96K68ZDySxT3u&utm_nooverride=1 -->
        <div class="col-12">
            Bedankt voor je bestelling! Wij gaan het zo snel mogelijk in orde maken.
        </div>
        <div class="col-12 text-end">
            <span class="autograph text-end me-3 mb-0 lh-1">Linda</span>
        </div>

        <div class="col-12 mt-0"><hr></div>

        <div class="col-6">
            <p class="text-uppercase text-muted mb-0">Bestelnummer</p>
            <p>5302</p>
        </div>
        <div class="col-6">
            <p class="text-uppercase text-muted mb-0">Datum</p>
            <p>21 november 2021</p>
        </div>
        <div class="col-6">
            <p class="text-uppercase text-muted mb-0">Betaalmethode</p>
            <p>iDeal</p>
        </div>
        <div class="col-6">
            <p class="text-uppercase text-muted mb-0">Verzendmethode</p>
            <p>PostNL verzending zonder track&trace</p>
        </div>
        <div class="col-6">
            <p class="text-uppercase text-muted mb-0">Kortingscode</p>
            <p><span class="font-monospace">KORTING123</span> (5 euro)</p>
        </div>
        <div class="col-6">
            <p class="text-uppercase text-muted mb-0">Totaal</p>
            <p>&euro; 21,75</p>
        </div>

        <div class="col-12"><hr></div>

        <div class="col-6 mt-3">
            <img src="{{url('/images/placeholder.jpg')}}" class="img-fluid" alt="...">
        </div>
        <div class="col-6 text-left text-sm-left mt-3">
            <a class="h4" href="{{ route('voorbeeld-product') }}">Frigg speen daisy maat 2 Baked clay</a>
            <p class="text-muted">&euro; 4,95 x 2 = &euro; 4,95</p>
        </div>

        <div class="col-6 mt-3">
            <img src="{{url('/images/placeholder.jpg')}}" class="img-fluid" alt="...">
        </div>
        <div class="col-6 text-left text-sm-left mt-3">
            <a class="h4" href="{{ route('voorbeeld-product') }}">Frigg speen daisy maat 2 Blush</a>
            <p class="text-muted">&euro; 4,95 x 3 = &euro; 14,85</p>
        </div>

        <div class="col-6 mt-3">
            <img src="{{url('/images/placeholder.jpg')}}" class="img-fluid" alt="...">
        </div>
        <div class="col-6 text-left text-sm-left mt-3">
            <a class="h4" href="{{ route('voorbeeld-product') }}">Frigg speen daisy maat 2 Cream</a>
            <p class="text-muted">&euro; 4,95 x 2 = &euro; 4,95</p>
        </div>
    </div>
@endsection
