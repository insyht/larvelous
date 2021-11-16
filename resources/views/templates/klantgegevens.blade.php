@extends('layouts.website')
@section('content')
    <h1>Gegevens</h1>

        <div class="row mt-5">
        <div class="col-5 col-sm-2">
            <p>Subtotaal:</p>
        </div>
        <div class="col-7 col-sm-10">
            <p>&euro; 24,75</p>
        </div>
        <div class="col-5 col-sm-2">
            <p>Verzendmethode:</p>
        </div>
        <div class="col-7 col-sm-10">
            <select class="form-select form-select-sm d-block d-sm-none" name="shippingMethod">
                <option selected value="shippingMethodPostNlNoTnT">&euro;2,00 (PostNL verzending zonder track&trace)</option>
                <option value="shippingMethodMailboxTnT">&euro;4,50 (Brievenbus pakket met track & trace)</option>
                <option value="shippingMethodPostNlTnT">&euro;6,05 (PostNL verzending met track&trace)</option>
            </select>

            <div class="d-none d-sm-block">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="shippingMethod" id="shippingMethodPostNlNoTnT" checked value="shippingMethodPostNlNoTnT">
                    <label class="form-check-label" for="shippingMethodPostNlNoTnT">
                        PostNL verzending zonder track&trace: &euro;2,00
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="shippingMethod" id="shippingMethodMailboxTnT" value="shippingMethodMailboxTnT">
                    <label class="form-check-label" for="shippingMethodMailboxTnT">
                        Brievenbus pakket met track & trace: &euro;4,50
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="shippingMethod" id="shippingMethodPostNlTnT" value="shippingMethodPostNlTnT">
                    <label class="form-check-label" for="shippingMethodPostNlTnT">
                        PostNL verzending met track&trace: &euro;6,05
                    </label>
                </div>
            </div>
        </div>
        <div class="col-5 col-sm-2 mt-sm-5">
            <p><strong>Totaal:</strong></p>
        </div>
        <div class="col-7 col-sm-10 mt-sm-5">
            <p class="mb-0"><strong>&euro; 26,75</strong>
            <p class="mt-0"><small class="text-muted">Inclusief &euro;4,64 btw</small></p>

        </div>
    </div>
@endsection
