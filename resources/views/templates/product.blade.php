@extends('layouts.website')
@section('content')
    <div class="row">
        <div class="col-12 col-sm-7">
            @include('blocks.product.images')
        </div>
        <div class="col-12 col-sm-5">
            <h1 class="h3">Frigg speen daisy maat 2 Baked clay</h1>
            <p class="d-none d-sm-block text-primary">&euro; 5,00</p>
            @include('blocks.product.options')
            @include('blocks.product.buy')
            @include('blocks.product.intro')
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h2>Productomschrijving</h2>
        </div>
        <div class="col">
            @include('blocks.product.paragraphs')
        </div>
    </div>

    <div class="row">
        <div class="col-12"><p class="h3">Gerelateerde producten</p></div>
        @include('blocks.product.product')
        @include('blocks.product.product')
        @include('blocks.product.product')
    </div>
@endsection
