@extends('layouts.website')
@section('content')
    @foreach ($page->getBlocks() as $block)
        @include("{$block->getView()}")
    @endforeach
@endsection
