@extends('layouts.header')

@section('content')

<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-3">
            <div class="text-center">
                <br>
                <img src="{{ asset('/uploads/avatars/'. $restaurant->avatar) }}" style="width: 150px; height: 150px; display: block; margin-left: auto; margin-right: auto;" class="card-img-top" alt="Card image cap">
            </div>
            <br>
            <div class="card">
                <h5 class="card-header">Over Ons</h5>
                <div class="card-body">
                    <p class="card-text">{{ $restaurant->biography }}</p>
                </div>
            </div>
            <br>
            @if (Auth::check())
            <a href="{{ URL::to('restaurant') }}/{{ $restaurant->id }}/edit"><button>Edit</button></a>
            @endif
        </div>
        <div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="gerechten-tab" data-toggle="tab" href="#gerechten" role="tab" aria-controls="gerechten" aria-selected="true">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Over Ons</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="gerechten" role="tabpanel" aria-labelledby="gerechten-tab">
                    <div class="row">
                        @foreach($restaurant->consumables as $consumable)
                            <div class="menu-content">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="dish-img"><a href="{{ route('consumable.edit', ['id' => $consumable->id]) }}"><img src="{{ asset('/uploads/avatars/'. $consumable->avatar) }}" style="width: 70px; height: 70px;" alt="" class="img-circle"></a></div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <div class="dish-content">
                                            <h5 class="dish-title">{{ $consumable->title }}</h5>
                                            <span class="dish-meta">
                                                @if($consumable->category == 1)
                                                    <td>Hoofdgerecht</td>
                                                @elseif($consumable->category == 2)
                                                    <td>Bijgerecht</td>
                                                @else
                                                    <td>Dranken</td>
                                                @endif
                                            </span>
                                            <div class="dish-price">
                                            <p>€{{ $consumable->price }}</p>
                                        </div>
                                        </div>
                                     </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="col-sm-9">
                        <br>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h4>Naam:</h4></label>
                                <h5>{{ $restaurant->name }}</h5>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="kvk"><h4>kvk:</h4></label>
                                <h5>{{ $restaurant->kvk }}</h5>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="zipcode"><h4>Postcode:</h4></label>
                                <h5>{{ $restaurant->zipcode }}</h5>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Stad:</h4></label>
                                <h5>{{ $restaurant->city }}</h5>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="phone"><h4>Telefoonnummer:</h4></label>
                                <h5>{{ $restaurant->phone }}</h5>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="email"><h4>E-mail:</h4></label>
                                <h5>{{ $restaurant->email }}</h5>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="email"><h4>Openingstijd:</h4></label>
                                <h5>{{ $restaurant->is_open }}</h5>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="email"><h4>Sluitingstijd:</h4></label>
                                <h5>{{ $restaurant->is_closed }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
