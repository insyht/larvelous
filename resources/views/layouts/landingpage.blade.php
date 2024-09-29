@include('elements/head')
@include('elements/top')
@include('elements/breadcrumb')
<div class="container-fluid">
{{--    <div class="row header pt-3 pt-sm-0 pb-3 mt-0 pb-sm-0 text-center text-sm-start" style="background-image: url('{{url('/images/fader.png')}}'), url('{{url('/images/header.jpg')}}');">--}}
{{--        @yield('header')--}}
{{--    </div>--}}
    @yield('content')
</div>

@include('elements/footer')
@include('elements/bottom')
