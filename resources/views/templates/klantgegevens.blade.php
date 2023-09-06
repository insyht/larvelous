@extends('insyht-larvelous::layouts.website')
@section('content')
    <h1>Gegevens</h1>
        <div class="row">
            <div class="col-12 mb-3"><p class="h4">Factuurgegevens</p></div>
            <div class="col-6 col-sm-4 mb-3 pe-1"><input class="form-control w-100 mandatory" type="text" name="invoice_first_name" placeholder="Voornaam"></div>
            <div class="col-6 col-sm-4 mb-3 ps-1 pe-sm-1"><input class="form-control w-100 mandatory" type="text" name="invoice_last_name" placeholder="Achternaam"></div>
            <div class="col-6 col-sm-4 mb-3 pe-1 ps-sm-1"><input class="form-control w-100" type="text" name="invoice_company_name" placeholder="Bedrijfsnaam"></div>
            <div class="col-6 d-sm-none mb-3 ps-1 pe-sm-1">
                <select class="form-select w-100 mandatory" name="invoice_country">
                    <option selected value="">Land / regio</option>
                    <option value="NL">Nederland</option>
                    <option value="BE">Belgi&euml;</option>
                    <option value="Other">Overige</option>
                </select>
            </div>

            <div class="col-8 col-sm-3 mb-3 pe-1"><input class="form-control w-100 mandatory" type="text" name="invoice_street" placeholder="Straatnaam"></div>
            <div class="col-2 col-sm-1 mb-3 ps-1 pe-1"><input class="form-control w-100 mandatory" type="text" name="invoice_house_number" placeholder="25"></div>
            <div class="col-2 col-sm-1 mb-3 ps-1 pe-sm-1"><input class="form-control w-100" type="text" name="invoice_house_number_ext" placeholder="B"></div>
            <div class="col-4 col-sm-1 mb-3 pe-1 ps-sm-1"><input class="form-control w-100 mandatory" type="text" name="invoice_postal_code" placeholder="Postcode"></div>
            <div class="col-8 col-sm-3 mb-3 ps-1 pe-sm-1"><input class="form-control w-100 mandatory" type="text" name="invoice_city" placeholder="Plaats"></div>
            <div class="col-6 col-sm-3 d-none d-sm-flex mb-3 ps-1 pe-sm-1">
                <select class="form-select w-100 mandatory" name="invoice_country">
                    <option selected value="">Land / regio</option>
                    <option value="NL">Nederland</option>
                    <option value="BE">Belgi&euml;</option>
                    <option value="Other">Overige</option>
                </select>
            </div>
            <div class="col-12 col-sm-2 mb-3 pe-sm-1">
                <input class="form-control w-100" type="text" name="invoice_phone" placeholder="Telefoonnummer">
            </div>
            <div class="col-12 col-sm-3 mb-3 ps-sm-1"><input class="form-control w-100 mandatory" type="email" name="invoice_email" placeholder="E-mailadres"></div>
            <div class="col-sm-7 d-none d-sm-flex"></div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="create_account">
                    <label class="form-check-label" for="create_account">Een account aanmaken?</label>
                </div>
            </div>

            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invoice_is_not_shipping">
                    <label class="form-check-label" for="invoice_is_shipping">Afwijkend verzendadres</label>
                </div>
            </div>

            <div class="d-none row" id="shipping_address">
                <div class="col-12 mb-3"><p class="h4">Verzendgegevens</p></div>
                <div class="col-6 col-sm-4 mb-3 pe-1"><input class="form-control w-100 mandatory" type="text" name="shipping_first_name" placeholder="Voornaam"></div>
                <div class="col-6 col-sm-4 mb-3 ps-1 pe-sm-1"><input class="form-control w-100 mandatory" type="text" name="shipping_last_name" placeholder="Achternaam"></div>
                <div class="col-6 col-sm-4 mb-3 pe-1 ps-sm-1"><input class="form-control w-100" type="text" name="shipping_company_name" placeholder="Bedrijfsnaam"></div>
                <div class="col-6 d-sm-none mb-3 ps-1 pe-sm-1">
                    <select class="form-select w-100 mandatory" name="shipping_country">
                        <option selected value="">Land / regio</option>
                        <option value="NL">Nederland</option>
                        <option value="BE">Belgi&euml;</option>
                        <option value="Other">Overige</option>
                    </select>
                </div>

                <div class="col-8 col-sm-3 mb-3 pe-1"><input class="form-control w-100 mandatory" type="text" name="shipping_street" placeholder="Straatnaam"></div>
                <div class="col-2 col-sm-1 mb-3 ps-1 pe-1"><input class="form-control w-100 mandatory" type="text" name="shipping_house_number" placeholder="25"></div>
                <div class="col-2 col-sm-1 mb-3 ps-1 pe-sm-1"><input class="form-control w-100" type="text" name="shipping_house_number_ext" placeholder="B"></div>
                <div class="col-4 col-sm-1 mb-3 pe-1 ps-sm-1"><input class="form-control w-100 mandatory" type="text" name="shipping_postal_code" placeholder="Postcode"></div>
                <div class="col-8 col-sm-3 mb-3 ps-1 pe-sm-1"><input class="form-control w-100 mandatory" type="text" name="shipping_city" placeholder="Plaats"></div>
                <div class="col-6 col-sm-3 d-none d-sm-flex mb-3 ps-1 pe-sm-1">
                    <select class="form-select w-100 mandatory" name="shipping_country">
                        <option selected value="">Land / regio</option>
                        <option value="NL">Nederland</option>
                        <option value="BE">Belgi&euml;</option>
                        <option value="Other">Overige</option>
                    </select>
                </div>

                <div class="col-12 col-sm-3 mb-3 pe-sm-1">
                    <input class="form-control w-100" type="text" name="shipping_phone" placeholder="Telefoonnummer">
                    <small><i class="bi bi-exclamation-triangle text-primary"></i> Mogelijk wordt hier verzendinfo op ontvangen</small>
                </div>
                <div class="col-12 col-sm-3 mb-3 ps-sm-1">
                    <input class="form-control w-100 mandatory" type="email" name="shipping_email" placeholder="E-mailadres">
                    <small><i class="bi bi-exclamation-triangle text-primary"></i> Mogelijk wordt hier verzendinfo op ontvangen</small>
                </div>
                <div class="col-sm-6 d-none d-sm-flex"></div>

                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="is_present">
                        <label class="form-check-label" for="is_present">Bestelling is een cadeautje</label><br>
                        <small>
                            <ul>
                                <li>Bestelling wordt in cadeaupapier verpakt</li>
                                <li>Er wordt geen factuur in het pakketje gestopt</li>
                                <li>De orderinformatie wordt niet naar het verzend-e-mailadres of verzend-telefoonnummer gestuurd maar naar het factuur-e-mailadres en/of factuur-telefoonnummer</li>
                            </ul>
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="subscribe_newsletter">
                    <label class="form-check-label" for="subscribe_newsletter">Schrijf me in voor de nieuwsbrief</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input mandatory" type="checkbox" value="" id="av">
                    <label class="form-check-label" for="av">Ik heb de <a href="#">algemene voorwaarden</a> van de website gelezen en ga hiermee akkoord.</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input mandatory" type="checkbox" value="" id="avg">
                    <label class="form-check-label" for="avg">Ik ga akkoord met de opslag en verwerking van mijn gegevens door deze website</label>
                </div>
            </div>

            <div class="col-12 mt-3"><p class="h4">Notities</p></div>
            <div class="col-12 mt-3">
                    <textarea class="form-control w-100" placeholder="Bestelnotities" id="notes" rows="5"></textarea>
            </div>

            <div class="col-12 mt-3"><p class="h4">Betaling</p></div>
            <div class="col-12 col-sm-3 mt-3">
                <select class="form-select" name="payment_method">
                    <option selected value="ideal">iDeal</option>
                    <option value="bancontact">Bancontact</option>
                </select>
            </div>
        </div>


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
                <select class="form-select form-select-sm d-block d-sm-none mandatory" name="shippingMethod">
                    <option selected value="shippingMethodPostNlNoTnT">&euro;2,00 (PostNL verzending zonder track&trace)</option>
                    <option value="shippingMethodMailboxTnT">&euro;4,50 (Brievenbus pakket met track & trace)</option>
                    <option value="shippingMethodPostNlTnT">&euro;6,05 (PostNL verzending met track&trace)</option>
                </select>
                <div class="d-none d-sm-block">
                    <div class="form-check">
                        <input class="form-check-input mandatory" type="radio" name="shippingMethod" id="shippingMethodPostNlNoTnT" checked value="shippingMethodPostNlNoTnT">
                        <label class="form-check-label" for="shippingMethodPostNlNoTnT">
                            PostNL verzending zonder track&trace: &euro;2,00
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input mandatory" type="radio" name="shippingMethod" id="shippingMethodMailboxTnT" value="shippingMethodMailboxTnT">
                        <label class="form-check-label" for="shippingMethodMailboxTnT">
                            Brievenbus pakket met track & trace: &euro;4,50
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input mandatory" type="radio" name="shippingMethod" id="shippingMethodPostNlTnT" value="shippingMethodPostNlTnT">
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

            <div class="col-12 col-sm-2 offset-sm-10">
                <a class="btn btn-primary w-100" href="{{ route('voorbeeld-bevestiging') }}"><strong>Afronden <i class="bi bi-arrow-right-circle-fill"></i></strong></a>
            </div>

        </div>
@endsection
