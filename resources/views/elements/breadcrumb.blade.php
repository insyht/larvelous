<div class="container">
    <div class="row">
        <div class="col-9">
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

        <div class="col-3">
            <form action="{{ route('insyht-larvelous-search') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="{{ __('insyht-larvelous::cms.search') }}" value="{{ $searchQuery ?? '' }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">{{ __('insyht-larvelous::cms.search') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
