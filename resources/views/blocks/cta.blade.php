<div class="container-fluid cta">
    <div class="row">
        <div class="col offset-sm-2 pt-3 pb-3 align-self-center">
            <p class="display-5 text-center text-sm-start">{{ $block->getBlockValues()->title }}</p>
            <p class="lead text-center text-sm-start">{{ $block->getBlockValues()->text }}</p>
        </div>
        <div class="col-sm pt-3 pb-3 align-self-center">
            <img src="{{ url($block->getBlockValues()->image) }}" class="img-fluid img-thumbnail">
        </div>
        <div class="col pt-3 pb-3 align-self-center text-center text-sm-start">
            <p class="h4">
                {{ $block->getBlockValues()->name }}
                @if(isset($block->getBlockValues()->function) && !empty($block->getBlockValues()->function))
                    <small class="text-muted">{{ $block->getBlockValues()->function }}</small>
                @endif
            </p>
            <p>{{ $block->getBlockValues()->phone_number }}</p>
            @if(isset($block->getBlockValues()->email) && !empty($block->getBlockValues()->email))
                <p>{{ $block->getBlockValues()->email }}</p>
           @endif
            <p><a href="{{ $block->getBlockValues()->url }}" class="btn btn-secondary">{{ $block->getBlockValues()->url_text }}</a></p>
        </div>
    </div>
</div>
