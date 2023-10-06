<div class="row header pt-3 pt-sm-0 pb-3 mt-0 pb-sm-0 text-center text-sm-start" style="background-image:url('{{ url('/images/fader.png') }}')@if(isset($block->getBlockValues()->image)), url('{{ url($block->getBlockValues()->image) }}')@endif;">
    <div class="col-12 col-sm-4 offset-sm- mt-sm-5 mb-sm-5">
        <h1 class="font-special">{{ $block->getBlockValues()->title }}</h1>
        <p class="fst-italic text-muted">{{ $block->getBlockValues()->subtitle }}</p>
        <p>{{ $block->getBlockValues()->text }}</p>

        @if($block->getBlockValues()->quote)
        <figure class="quote mb-5 p-3 text-center text-sm-start mt-sm-5 mb-sm-5">
            <blockquote class="blockquote">
                <p>{{ $block->getBlockValues()->quote }}</p>
            </blockquote>
            @if($block->getBlockValues()->quote_name)
            <figcaption class="blockquote-footer">
                {{ $block->getBlockValues()->quote_name}}
                @if($block->getBlockValues()->quote_city)
                , <cite title="Source Title">{{ $block->getBlockValues()->quote_city }}</cite>
                @endif
            </figcaption>
            @endif
        </figure>
        @endif

        @if($block->getBlockValues()->url)
        <p class="mt-sm-5 mb-sm-5">
            <a href="{{ $block->getBlockValues()->url }}" class="btn-lg btn-primary">
                @if($block->getBlockValues()->url_text)
                    {{ $block->getBlockValues()->url_text }}
                @else
                    {{ $block->getBlockValues()->url }}
                @endif
            </a>
        </p>
        @endif
    </div>
</div>
