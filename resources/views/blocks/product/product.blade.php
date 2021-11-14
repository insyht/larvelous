<div class="col-12 col-sm-4 mt-3">
    <a href="/voorbeeld/product">
        <div class="card">
            @if (isset($sale) && $sale === true)
            <div class="ribbon-wrapper">
                <div class="ribbon  green">
                    Sale
                </div>
            </div>
            @endif
            <img src="{{url('/images/placeholder.jpg')}}" class="card-img-top" alt="...">
{{--            <div class="text-center text-light text-uppercase @if (isset($sale) && $sale === true)bg-success @else--}}
{{--                    bg-transparent @endif ">--}}
{{--                @if (isset($sale) && $sale === true)--}}
{{--                    Sale--}}
{{--                @else--}}
{{--                    &nbsp;--}}
{{--                @endif--}}
{{--            </div>--}}
            <div class="card-body">
                <h5 class="card-title text-center">Productnaam</h5>
                <p class="card-text text-center">&euro; 5,00</p>
                <a href="#" class="btn btn-primary btn-lg col-12"><i class="bi bi-bag"></i></a>
            </div>
        </div>
    </a>
</div>
