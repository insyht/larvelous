@extends('layouts.website')
@section('content')
    <div class="row">
        <div class="col">
            <img src="{{url('/images/placeholder.jpg')}}" class="img-fluid w-100">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="lead">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ullamcorper, purus a volutpat
                euismod, risus orci ultrices turpis, ut ornare elit quam tristique felis. Sed ac mauris efficitur,
                tempor ante ac, venenatis magna. Vestibulum eget faucibus mauris, et condimentum nibh. Duis gravida
                augue id pharetra semper. Cras imperdiet, purus non imperdiet ultricies, odio odio venenatis felis,
                vitae tempor tortor turpis eu turpis.
            </p>
        </div>
    </div>

    <div class="row justify-content-between">
        <div class="col">
            <p class="h3 w-100">9 Producten <small class="text-muted">12 Producten totaal</small></p>
        </div>
        <div class="col-3">
            <div class="dropdown">
                <button class="btn btn-lg btn-primary dropdown-toggle w-100" type="button" id="sortProducts"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-sort-down"></i> Prijs (laag-hoog)
                </button>
                <ul class="dropdown-menu" aria-labelledby="sortProducts">
                    <li>
                        <button class="dropdown-item active" type="button">Prijs (laag-hoog)</button>
                    </li>
                    <li>
                        <button class="dropdown-item" type="button">Prijs (hoog-laag)</button>
                    </li>
                    <li>
                        <button class="dropdown-item" type="button">Beoordeling (hoog-laag)</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <p class="h1">Filters</p>

            <p class="h3">Maat</p>
            <div class="list-group mb-4">
                <button type="button" class="list-group-item list-group-item-action">Maat 1</button>
                <button type="button" class="list-group-item list-group-item-action">Maat 2</button>
                <button type="button" class="list-group-item list-group-item-action">Maat 3</button>
                <button type="button" class="list-group-item list-group-item-action">Maat 4</button>
            </div>

            <p class="h3">Kleur</p>
            <div class="list-group mb-4">
                <button type="button" class="list-group-item list-group-item-action">Rood</button>
                <button type="button" class="list-group-item list-group-item-action active" aria-current="true">Groen</button>
                <button type="button" class="list-group-item list-group-item-action">Blauw</button>
                <button type="button" class="list-group-item list-group-item-action">Roze</button>
                <button type="button" class="list-group-item list-group-item-action active" aria-current="true">Wit</button>
                <button type="button" class="list-group-item list-group-item-action">Geel</button>
                <button type="button" class="list-group-item list-group-item-action">Zwart</button>
            </div>

            <p class="h3">Lengte</p>
            <div class="list-group mb-4">
                <label for="filter-length-min" class="form-label">Minimaal</label>
                <div class="row mt-0 mb-0">
                    <div class="col">
                        <input type="range" class="form-range" min="0" max="100" value="10" id="filter-length-min" oninput="document.getElementById('filter-length-min-value').innerHTML = this.value + 'cm'">
                    </div>
                    <div class="col" id="filter-length-min-value">10 cm</div>
                </div>
                <label for="filter-length-max" class="form-label">Maximaal</label>
                <div class="row mt-0 mb-0">
                    <div class="col">
                        <input type="range" class="form-range " min="0" max="100" value="80" id="filter-length-max" oninput="document.getElementById('filter-length-max-value').innerHTML = this.value + 'cm'">
                    </div>
                    <div class="col" id="filter-length-max-value">80 cm</div>
                </div>
            </div>

            <p class="h3">Merk</p>
            <div class="list-group mb-4">
                <button type="button" class="list-group-item list-group-item-action">Bibs</button>
                <button type="button" class="list-group-item list-group-item-action active" aria-current="true">Frigg
                </button>
                <button type="button" class="list-group-item list-group-item-action">Mushie</button>
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col">
                    <a href="/voorbeeld/subcategorie">
                        <div class="card">
                            <img src="{{url('/images/placeholder.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">Subcategorie</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="/voorbeeld/subcategorie">
                        <div class="card">
                            <img src="{{url('/images/placeholder.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">Subcategorie</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="/voorbeeld/subcategorie">
                        <div class="card">
                            <img src="{{url('/images/placeholder.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">Subcategorie</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <a href="/voorbeeld/product">
                        <div class="card">
                            <img src="{{url('/images/placeholder.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">Productnaam</h5>
                                <p class="card-text text-center">&euro; 5,00</p>
                                <a href="#" class="btn btn-primary btn-lg col-12"><i class="bi bi-bag"></i></a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="/voorbeeld/product">
                        <div class="card">
                            <img src="{{url('/images/placeholder.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">Productnaam</h5>
                                <p class="card-text text-center">&euro; 5,00</p>
                                <a href="#" class="btn btn-primary btn-lg col-12"><i class="bi bi-bag"></i></a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="/voorbeeld/product">
                        <div class="card">
                            <img src="{{url('/images/placeholder.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">Productnaam</h5>
                                <p class="card-text text-center">&euro; 5,00</p>
                                <a href="#" class="btn btn-primary btn-lg col-12"><i class="bi bi-bag"></i></a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="/voorbeeld/product">
                        <div class="card">
                            <img src="{{url('/images/placeholder.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">Productnaam</h5>
                                <p class="card-text text-center">&euro; 5,00</p>
                                <a href="#" class="btn btn-primary btn-lg col-12"><i class="bi bi-bag"></i></a>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <a href="/voorbeeld/product">
                        <div class="card">
                            <img src="{{url('/images/placeholder.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">Productnaam</h5>
                                <p class="card-text text-center">&euro; 5,00</p>
                                <a href="#" class="btn btn-primary btn-lg col-12"><i class="bi bi-bag"></i></a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="/voorbeeld/product">
                        <div class="card">
                            <img src="{{url('/images/placeholder.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">Productnaam</h5>
                                <p class="card-text text-center">&euro; 5,00</p>
                                <a href="#" class="btn btn-primary btn-lg col-12"><i class="bi bi-bag"></i></a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="/voorbeeld/product">
                        <div class="card">
                            <img src="{{url('/images/placeholder.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">Productnaam</h5>
                                <p class="card-text text-center">&euro; 5,00</p>
                                <a href="#" class="btn btn-primary btn-lg col-12"><i class="bi bi-bag"></i></a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="/voorbeeld/product">
                        <div class="card">
                            <img src="{{url('/images/placeholder.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">Productnaam</h5>
                                <p class="card-text text-center">&euro; 5,00</p>
                                <a href="#" class="btn btn-primary btn-lg col-12"><i class="bi bi-bag"></i></a>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <a href="/voorbeeld/product">
                        <div class="card">
                            <img src="{{url('/images/placeholder.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">Productnaam</h5>
                                <p class="card-text text-center">&euro; 5,00</p>
                                <a href="#" class="btn btn-primary btn-lg col-12"><i class="bi bi-bag"></i></a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="/voorbeeld/product">
                        <div class="card">
                            <img src="{{url('/images/placeholder.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">Productnaam</h5>
                                <p class="card-text text-center">&euro; 5,00</p>
                                <a href="#" class="btn btn-primary btn-lg col-12"><i class="bi bi-bag"></i></a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="/voorbeeld/product">
                        <div class="card">
                            <img src="{{url('/images/placeholder.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">Productnaam</h5>
                                <p class="card-text text-center">&euro; 5,00</p>
                                <a href="#" class="btn btn-primary btn-lg col-12"><i class="bi bi-bag"></i></a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="/voorbeeld/product">
                        <div class="card">
                            <img src="{{url('/images/placeholder.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">Productnaam</h5>
                                <p class="card-text text-center">&euro; 5,00</p>
                                <a href="#" class="btn btn-primary btn-lg col-12"><i class="bi bi-bag"></i></a>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <nav aria-label="...">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link">Vorige</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Volgende</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            </div>
        </div>

@endsection
