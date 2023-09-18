@extends('insyht-larvelous::layouts.landingpage')
@section('header')
        <div class="col-12 col-sm-4 offset-sm- mt-sm-5 mb-sm-5">
            <h1 class="font-special">De beste kralen, de mooiste kleuren</h1>
            <p class="fst-italic text-muted">Kies uit onze modellen of stel zelf samen</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sagittis egestas vestibulum. Praesent
                vulputate dolor tortor, eu viverra sapien interdum at. Ut sit amet sem leo. Donec et mauris tellus.
                Praesent ut consequat nunc. Morbi venenatis non lacus non rhoncus. Duis eu lectus sed felis consequat
                tempor. In eget rhoncus neque, sit amet bibendum urna. </p>

            <figure class="quote mb-5 p-3 text-center text-sm-start mt-sm-5 mb-sm-5">
                <blockquote class="blockquote">
                    <p>Het perfecte kraamcadeau voor de kleine meid van mijn beste vriendin!</p>
                </blockquote>
                <figcaption class="blockquote-footer">
                    Linda Vishers, <cite title="Source Title">Made</cite>
                </figcaption>
            </figure>

            <p class="mt-sm-5 mb-sm-5">
                <a href="{{ route('voorbeeld-categorie') }}" class="btn-lg btn-primary">Bekijk de collectie</a>
            </p>
        </div>
@endsection
@section('content')
    @include('insyht-larvelous::blocks/brands')
    @include('insyht-larvelous::blocks/usps')
    @include('insyht-larvelous::blocks/paragraph')
    @include('insyht-larvelous::blocks/cta')
@endsection
