@extends('layouts.website')
@section('content')
    <h1>Winkelwagen</h1>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">&nbsp;</th>
                <th scope="col">Product</th>
                <th scope="col">Prijs</th>
                <th scope="col">Aantal</th>
                <th scope="col">Subtotaal</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row" class="align-middle">
                    <a href="#">
                        <i class="bi bi-trash"></i>
                    </a>
                </th>
                <td>
                    <div class="">
                        <img src="{{url('/images/placeholder.jpg')}}" class="img-fluid" alt="...">
                    </div>
                </td>
                <td>Frigg speen daisy maat 2 Baked clay</td>
                <td>&euro; 4,95</td>
                <td><div class="input-group"><input class="form-control" value="1" min="1" max="999" type="number" name="amount"></div>
                </td>
                <td>&euro; 4,95</td>
            </tr>
            <tr>
                <th scope="row" class="align-middle">
                    <a href="#">
                        <i class="bi bi-trash"></i>
                    </a>
                </th>
                <td>
                    <div class="ratio ratio-1x1">
                        <img src="{{url('/images/placeholder.jpg')}}" class="img-thumbnail w-100 h-100" alt="...">
                    </div>
                </td>
                <td>Frigg speen daisy maat 2 Blush</td>
                <td>&euro; 4,95</td>
                <td><div class="input-group"><input class="form-control" value="3" min="1" max="999" type="number" name="amount"></div>
                </td>
                <td>&euro; 14,85</td>
            </tr>
            <tr>
                <th scope="row" class="align-middle">
                    <a href="#">
                        <i class="bi bi-trash"></i>
                    </a>
                </th>
                <td>
                    <div class="ratio ratio-1x1">
                        <img src="{{url('/images/placeholder.jpg')}}" class="img-thumbnail w-100 h-100" alt="...">
                    </div>
                </td>
                <td> Frigg speen daisy maat 2 Cream</td>
                <td>&euro; 4,95</td>
                <td><div class="input-group"><input class="form-control" value="1" min="1" max="999" type="number" name="amount"></div>
                </td>
                <td>&euro; 4,95</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
