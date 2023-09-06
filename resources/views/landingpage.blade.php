@extends('insyht-larvelous::layouts.landingpage')
@section('content')
    @foreach ($page->getBlocks() as $block)
        @include("{$block->getView()}")
    @endforeach
@endsection
