<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Musthaves4U</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @inject('helper', '\Insyht\Larvelous\Helpers\LarvelousHelper')
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @foreach($helper->getMenu('main_menu')->items as $item)
                            @if ($item->canHaveChildren() && $item->getChildren()->isNotEmpty())
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle @if ($item->isActive(true)) active @endif" @if ($item->isActive(true)) aria-current="page" @endif href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ $item->getTitle() }}</a>
                                    <ul class="dropdown-menu">
                                        @foreach($item->getChildren() as $child)
                                            @if (!empty($item->getUrl()))
                                                <li><a class="dropdown-item @if ($item->isActive()) active @endif" href="/{{ $item->getUrl() }}">{{ $item->getTitle() }}</a></li>
                                            @endif
                                            <li><a class="dropdown-item @if ($child->isActive()) active @endif" href="/{{ $child->getUrl() }}">{{ $child->getTitle() }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item">
                                  <a class="nav-link @if ($item->isActive()) active @endif" @if ($item->isActive()) aria-current="page" @endif href="/{{ $item->getUrl() }}">{{ $item->getTitle() }}</a>
                                </li>
                            @endif
                        @endforeach
                        <li class="nav-item"><a class="nav-link" href="/">||</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorie</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('voorbeeld-categorie') }}">Categorie</a></li>
                                <li><a class="dropdown-item" href="{{ route('voorbeeld-categorie') }}">Subcategorie</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('voorbeeld-winkelwagen') }}">Winkelwagen</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('voorbeeld-klantgegevens') }}">Klantgegevens</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('voorbeeld-bevestiging') }}">Bevestiging</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('voorbeeld-contact') }}">Contact</a></li>
                    </ul>
                </div>
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
