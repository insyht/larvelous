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
