@extends('layouts.website')
@section('content')
    <h1>Contact</h1>
    <div class="row">
        <div class="col-12 col-sm-6">
            <div class="row">
                <div class="col-12">
                    <h3>Stuur ons een bericht</h3>
                    <p>
                        Consectetur adipiscing elit. Proin ut magna et nibh dictum dignissim.
                        Curabitur imperdiet tellus ac dolor dictum consequat.
                    </p>
                </div>

                <div class="col-6 mb-3">
                    <input class="form-control w-100 mandatory" type="text" name="first_name" placeholder="Voornaam">
                </div>
                <div class="col-6 mb-3">
                    <input class="form-control w-100 mandatory" type="text" name="last_name" placeholder="Achternaam">
                </div>

                <div class="w-100"></div>

                <div class="col-6 mb-3">
                    <input class="form-control w-100 mandatory" type="email" name="invoice_email" placeholder="E-mailadres">
                </div>
                <div class="col-6 mb-3">
                    <input class="form-control w-100" type="text" name="invoice_phone" placeholder="Telefoonnummer">
                </div>

                <div class="col-12">
                    <textarea class="form-control w-100 mandatory" placeholder="Bestelnotities" id="notes" rows="5"></textarea>
                </div>

                <div class="col-12 mt-3">
                    <div class="form-check">
                        <input class="form-check-input mandatory" type="checkbox" value="" id="avg">
                        <label class="form-check-label" for="avg">Ik ga akkoord met de opslag en verwerking van mijn gegevens door deze website</label>
                    </div>
                </div>

                <div class="col-12 col-sm-4 mt-3">
                    <a class="btn btn-primary w-100" href="{{ route('voorbeeld-bevestiging') }}">
                        <strong>Bericht versturen</strong>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 d-none d-sm-flex">
            <div class="row">
                <div class="col-12">
                    <img class="img-fluid" src="{{url('/images/placeholder.jpg')}}">
                </div>
            </div>
        </div>
    </div>
@endsection
