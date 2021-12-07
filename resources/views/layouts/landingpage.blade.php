<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Homepage</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/m4u.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
              <a class="navbar-brand" href="#">Musthaves4U</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="/">Homepage</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Categorie
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('voorbeeld-categorie') }}">Categorie</a>
                      <a class="dropdown-item" href="{{ route('voorbeeld-categorie') }}">Subcategorie</a>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('voorbeeld-product') }}">Product</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('voorbeeld-winkelwagen') }}">Winkelwagen</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('voorbeeld-klantgegevens') }}">Klantgegevens</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('voorbeeld-bevestiging') }}">Bevestiging</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('voorbeeld-textpagina') }}">Textpagina</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('voorbeeld-landingspagina') }}">Landingspagina</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('voorbeeld-contact') }}">Contact</a>
                  </li>
                </ul>
              </div>
            </nav>
        </div>
        <div class="row">
            <div class="col-sm text-center">
                <i class="bi bi-stopwatch"></i> Op werkdagen voor 15:00 besteld, morgen in huis
            </div>
            <div class="col-sm text-center">
                <i class="bi bi-truck"></i> Verzendkosten vanaf &euro;1
            </div>
            <div class="col-sm text-center">
                <i class="bi bi-piggy-bank"></i> Gratis verzending binnen NL > &euro;50
            </div>
            <div class="col-sm text-center">
                <i class="bi bi-bag"></i> Afhalen mogelijk
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pagina</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row d-block d-sm-none mb-0">
            <div class="col-12 header-mobile" style="background-image: url('{{url('/images/header.jpg')}}');">
                &nbsp;
            </div>
        </div>
        <div class="row header pt-3 pt-sm-0 pb-3 mt-0 pb-sm-0 text-center text-sm-start" style="background-image: url('{{url('/images/fader.png')}}'), url('{{url('/images/header.jpg')}}');">
            @yield('header')
        </div>
        @yield('content')
    </div>

    <footer class="page-footer bg-dark text-white container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <p class="h3">Bedrijfsgegevens</p>
                    <p><i class="bi bi-briefcase"></i> KvK: 67461247</p>
                    <p><i class="bi bi-journal"></i> BTW: NL002216943B98</p>
                    <p><i class="bi bi-bank"></i> NL95 RABO 0316 2961 39</p>
                </div>
                <div class="col-sm">
                    <p class="h3">Handige pagina's</p>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Alles over Musthaves4u</a></li>
                        <li><a href="#">Algemene voorwaarden</a></li>
                        <li><a href="#">Privacybeleid</a></li>
                        <li><a href="#">Disclaimer</a></li>
                        <li><a href="#">Retourbeleid</a></li>
                        <li><a href="#">Contact opnemen</a></li>
                        <li><a href="#">Mijn account</a></li>
                    </ul>
                </div>
                <div class="col-sm">
                    <p class="h3">Klantenservice</p>
                    <p><i class="bi bi-geo-alt"></i> Klaproos 8, Made</p>
                    <p><i class="bi bi-envelope-open"></i> contact@musthaves4u.nl</p>
                    <p><i class="bi bi-telephone"></i> 06 155 74 518</p>
                    <p><a href="#"><i class="bi bi-globe"></i> Musthaves4U.nl</a></p>
                </div>
                <div class="col-sm">
                    <p class="h3">Musthaves4U</p>
                    <p class="lead">
                        Gratis verzending<br>
                        <small class="text-muted">Nederlandse orders boven 100 euro</small>
                    </p>
                    <p class="lead">
                        Niet goed, geld terug<br>
                        <small class="text-muted">100% geld terug garantie</small>
                    </p>
                    <p class="lead">
                        24/7 bereikbaar<br>
                        <small class="text-muted">Via e-mail, Whatsapp en telefonisch</small>
                    </p>
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
