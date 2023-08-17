<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        @if (isset($page->title))
                            {{ $page->title }}
                        @elseif (isset($breadcrumb))
                            {!! $breadcrumb !!}
                        @endif
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
