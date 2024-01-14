<div class="container">
    <div class="row d-none d-sm-flex">
        @if(isset($block->getBlockValues()->image_left) && !empty($block->getBlockValues()->image_left))
            <div class="col-3">
                <img src="{{url($block->getBlockValues()->image_left)}}" class="img-fluid img-thumbnail">
            </div>
        @endif

        @if(isset($block->getBlockValues()->image_left) && !empty($block->getBlockValues()->image_left) && isset($block->getBlockValues()->image_right) && !empty($block->getBlockValues()->image_right))
            <div class="col-6">

        @elseif ((isset($block->getBlockValues()->image_left) && !empty($block->getBlockValues()->image_left)) || (isset($block->getBlockValues()->image_right) && !empty($block->getBlockValues()->image_right)))
            <div class="col-9">
        @else
            <div class="col-12">
        @endif
            <p class="display-4">{{ $block->getBlockValues()->title }}</p>
            <p class="lead">{{ $block->getBlockValues()->text }}</p>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="E-mailadres" aria-label="E-mailadres" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2">Aanmelden</button>
            </div>
        </div>

        @if(isset($block->getBlockValues()->image_right) && !empty($block->getBlockValues()->image_right))
            <div class="col-3">
                <img src="{{url($block->getBlockValues()->image_right)}}" class="img-fluid img-thumbnail">
            </div>
        @endif
    </div>


    <div class="row d-flex d-sm-none">
        @if(isset($block->getBlockValues()->image_left) && !empty($block->getBlockValues()->image_left))
            <div class="col-6">
                <img src="{{url($block->getBlockValues()->image_left)}}" class="img-fluid img-thumbnail">
            </div>
        @endif

        @if(isset($block->getBlockValues()->image_left) && !empty($block->getBlockValues()->image_left))
            <div class="col-6 display-5">
        @else
            <div class="col-12 display-5">
        @endif
                {{ $block->getBlockValues()->title }}
            </div>
            <div class="col-12 lead">{{ $block->getBlockValues()->text }}</div>

        @if(isset($block->getBlockValues()->image_right) && !empty($block->getBlockValues()->image_right))
            <div class="col-6 align-self-center">
        @else
            <div class="col-12 align-self-center">
        @endif
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="E-mailadres" aria-label="E-mailadres" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Aanmelden</button>
                </div>
            </div>

        @if(isset($block->getBlockValues()->image_right) && !empty($block->getBlockValues()->image_right))
            <div class="col-6">
                <img src="{{url($block->getBlockValues()->image_right)}}" class="img-fluid img-thumbnail">
            </div>
        @endif
    </div>
</div>
