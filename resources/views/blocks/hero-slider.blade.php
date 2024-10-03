@if(isset($block->getBlockValues()->slide) && count($block->getBlockValues()->slide) > 0)
    <div class="container">
        <div class="row">
            <div class="col-12 text-center larvelous-slider">
                @foreach($block->getBlockValues()->slide as $slide)
                    <div class="larvelous-slide">
                        <div class="larvelous-slide-text">{{ $slide->text }}</div>
                        <img src="{{ url($slide->image) }}" alt="{{ $slide->text }}" class="larvelous-slide-image">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
