<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <p class="text-secondary fw-lighter"><em>{{ $block->getBlockValues()->title }}</em></p>
        </div>
        <div class="col-4 col-sm-2 offset-2 offset-sm-2 mb-2"><img src="{{url($block->getBlockValues()->image[0])}}" class="img-fluid"></div>
        <div class="col-4 col-sm-2 mb-2"><img src="{{url($block->getBlockValues()->image[1])}}" class="img-fluid"></div>
        <div class="col-4 col-sm-2 offset-2 offset-sm-0 mb-2"><img src="{{url($block->getBlockValues()->image[2])}}" class="img-fluid"></div>
        <div class="col-4 col-sm-2 mb-2"><img src="{{url($block->getBlockValues()->image[3])}}" class="img-fluid"></div>
    </div>
</div>





