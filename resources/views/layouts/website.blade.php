@include('elements/head')
@include('elements/top')
@include('elements/breadcrumb')

<div class="container">
    <h1>{{ $page->title }}</h1>
    @yield('content')
</div>

@include('elements/footer')
@include('elements/bottom')
