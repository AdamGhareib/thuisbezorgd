@extends('layouts.header')

@section('content')

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

@stop
