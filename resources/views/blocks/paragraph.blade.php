<div class="container">
    <div class="row">
        @if(isset($block->getBlockValues()->image) && (!isset($block->getBlockValues()->image_position) || $block->getBlockValues()->image_position === 'left'))
            <div class="col-sm"><img src="{{url($block->getBlockValues()->image)}}" class="img-fluid"></div>
        @endif
        <div class="col mt-3">
            <h3>{{ $block->getBlockValues()->title }}</h3>
            <p>
                {{ $block->getBlockValues()->text }}
            </p>
            @isset($block->getBlockValues()->url)
            <p>
                <a href="{{ $block->getBlockValues()->url }}" class="btn btn-secondary">
                    @isset($block->getBlockValues()->url_text)
                        {{ $block->getBlockValues()->url_text }}
                    @endisset
                    @empty($block->getBlockValues()->url_text)
                        {{ $block->getBlockValues()->url }}
                    @endisset
                </a>
            </p>
            @endisset
        </div>
        @if(isset($block->getBlockValues()->image) && isset($block->getBlockValues()->image_position) && $block->getBlockValues()->image_position === 'right')
            <div class="col-sm"><img src="{{url($block->getBlockValues()->image)}}" class="img-fluid"></div>
        @endif
    </div>
</div>
