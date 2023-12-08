<div class="container">
    <div class="row">
        @for ($i = 0; $i <= 2; $i++)
        <div class="col-12 col-sm-2 offset-sm-2 text-center">
            <p><i class="{{ $block->getBlockValues()->icon[$i] }} usp-icon text-primary"></i></p>
            <p class="text-muted lead text-uppercase">{{ $block->getBlockValues()->title[$i] }}</p>
            <p class="lead">{{ $block->getBlockValues()->text[$i] }}</p>
        </div>
        @endfor
    </div>
</div>
