@include('elements/head')
@include('elements/top')
@include('elements/breadcrumb')
<div class="container-fluid">
    <div class="row d-block d-sm-none mb-0">
        <div class="col-12 header-mobile" style="background-image: url('{{url('/images/header.jpg')}}');">
            &nbsp;
        </div>
    </div>
    <div class="row header pt-3 pt-sm-0 pb-3 mt-0 pb-sm-0 text-center text-sm-start" style="background-image: url('{{url('/images/fader.png')}}'), url('{{url('/images/header.jpg')}}');">
        @yield('header')
    </div>
    @yield('content')
</div>

@include('elements/footer')
@include('elements/bottom')
