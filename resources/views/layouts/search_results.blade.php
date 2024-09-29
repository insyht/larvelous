@include('elements/head')
@include('elements/top')
@include('elements/breadcrumb')

<div class="container">
    <h1>{{ __('insyht-larvelous::cms.search_results_for', ['query' => $searchQuery]) }} ({{ count($results) }})</h1>
    <div class="search_results">
        @if (count($results) > 0)
            <div class="search_result">
                @foreach ($results as $resultsForUrl)
                    <a href="{{ $resultsForUrl['url'] }}">{{ $resultsForUrl['title'] }}</a>
                    <ul>
                        @foreach ($resultsForUrl['results'] as $result)
                        @if (!empty($result->getDescription()))
                            <li>{!! $result->getDescription() !!}</li>
                        @endif
                        @endforeach
                    </ul>
                @endforeach
            </div>
        @else
            <div class="no-search-results">
                <p>{{ __('insyht-larvelous::cms.no_search_results') }}</p>
            </div>
        @endif
    </div>
</div>

@include('elements/footer')
@include('elements/bottom')
