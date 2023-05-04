@include('elements/head')
@include('elements/top')
@include('elements/breadcrumb')

<div class="container">
    @yield('content')
</div>

@include('elements/footer')
@include('elements/bottom')
