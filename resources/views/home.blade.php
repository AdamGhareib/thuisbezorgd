@extends('layouts.header')

@section('content')

<div class="container">
    <header class="jumbotron my-4">
        <h1 class="display-3 text-center">Welkom Bij Thuisbezorgd</h1>
        <div class="form-inline w-100 d-none d-md-block ml-2">
            <div class="form-group">
                <input type="text" class="form-control form-control-sm rounded-pill search border-0 px-3 w-100" name="restaurant" id="restaurant" autocomplete="off" placeholder="search">
                <div id="restaurantList"></div>
            </div>
            {{ csrf_field() }}
        </div>
    </header>

    <div class="row text-center">
        @foreach($restaurants as $restaurant)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100">
                    <img class="card-img-top" src="{{ asset('/uploads/avatars/'. $restaurant->avatar) }}" alt="">
                    <div class="card-body">
                        <h4 class="card-title">{{ $restaurant->name }}</h4>
                        <p class="card-text">{{ $restaurant->biography }}</p>
                        <p class="card-text">Sluit om {{ $restaurant->is_closed }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="restaurant/{{$restaurant->name}}" class="btn btn-primary">Go To Restaurant!</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@stop
