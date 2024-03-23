@include('elements/head')
@include('elements/top')
@include('elements/breadcrumb')

<div class="container">
    @if (isset($page->title))<h1>{{ $page->title }}</h1>@endif
    @yield('content')
</div>

@include('elements/footer')
@include('elements/bottom')
