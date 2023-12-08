@include('insyht-larvelous::elements/head')
@include('insyht-larvelous::elements/top')
@include('insyht-larvelous::elements/breadcrumb')

<div class="container">
    @if (isset($page->title))<h1>{{ $page->title }}</h1>@endif
    @yield('content')
</div>

@include('insyht-larvelous::elements/footer')
@include('insyht-larvelous::elements/bottom')
