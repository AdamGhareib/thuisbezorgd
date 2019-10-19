@extends('layouts.header')

@section('content')

@guest
    <div class="container bootstrap snippet">
        <div class="row">
            <div class="col-sm-3">
                <div class="text-center">
                    <br>
                    <img src="{{ asset('/uploads/avatars/'. $user->avatar) }}" style="width: 150px; height: 150px; border-radius: 50%; display: block; margin-left: auto; margin-right: auto;" class="card-img-top" alt="Card image cap">
                </div>
                <div class="col-sm-9">
                    <br>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="first_name"><h4>Name:</h4></label>
                            <h5>{{ $user->first_name }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endguest

@auth
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-3">
            <div class="text-center">
                <br>
                <img src="{{ asset('/uploads/avatars/'. $user->avatar) }}" style="width: 150px; height: 150px; border-radius: 50%; display: block; margin-left: auto; margin-right: auto;" class="card-img-top" alt="Card image cap">
            </div>
            <br>
            @if (Auth::user()->id == $user->id)
            <form action="{{ asset('editprofile') }}">
                <input type="submit" class="btn btn-info" value="Edit profile" />
            </form>
            @endif
            <br>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Maak een Restaurant</button>
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Maak Een Restaurant</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['route' => 'restaurant.store', 'method' => 'POST']) !!}
                            <label for="name"><h4>Naam:</h4></label>
                            {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'naam','autocomplete' => 'off']); !!}
                            <br>
                            <label for="kvk"><h4>KVK:</h4></label>
                            {!! Form::text('kvk', '', ['class' => 'form-control', 'placeholder' => 'KVK','autocomplete' => 'off']); !!}
                            <br>
                            <label for="zipcode"><h4>Postcode:</h4></label>
                            {!! Form::text('zipcode', '', ['class' => 'form-control', 'placeholder' => 'postcode','autocomplete' => 'off']); !!}
                            <br>
                            <label for="city"><h4>Stad:</h4></label>
                            {!! Form::text('city', '', ['class' => 'form-control', 'placeholder' => 'stad','autocomplete' => 'off']); !!}
                            <br>
                            <label for="phone"><h4>Telefoonnummer:</h4></label>
                            {!! Form::text('phone', '', ['class' => 'form-control', 'placeholder' => 'telefoonnummer','autocomplete' => 'off']); !!}
                            <br>
                            <label for="email"><h4>E-mail:</h4></label>
                            {!! Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'e-mail','autocomplete' => 'off']); !!}
                            <br>
                            <label for="biography"><h4>Over ons:</h4></label>
                            {!! Form::text('biography', '', ['class' => 'form-control', 'placeholder' => 'over ons','autocomplete' => 'off']); !!}
                            <br>
                            <label for="is_open"><h4>Openingstijd:</h4></label>
                            {!! Form::time('is_open', '', ['class' => 'form-control', 'placeholder' => 'openingstijd','autocomplete' => 'off']); !!}
                            <br>
                            <label for="is_closed"><h4>Sluitingstijd:</h4></label>
                            {!! Form::time('is_closed', '', ['class' => 'form-control', 'placeholder' => 'sluitingstijd','autocomplete' => 'off']); !!}
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info">Maak Restaurant</button>
                        </div>
                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <br>
            <br>
            @php
                $restaurants = $user->restaurants()->orderBy('id', 'desc')->get();
                $total = count($restaurants);
            @endphp
            @if($total > 0)
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">Mijn Restaurant</button>
            @endif
            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Mijn Restaurant</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ol>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Mijn Restaurant</th>
                                            <th>Bewerken</th>
                                            <th>Verwijderen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($restaurants as $restaurant)
                                            <tr>
                                                <td>{{ $restaurant->name }}</td>
                                                <th><a href="{{ URL::to('restaurant') }}/{{ $restaurant->id }}/edit" class="btn btn-info">Bewerk</a></th>
                                                <th>
                                                    {!! Form::open(['route' => ['restaurant.destroy', $restaurant->id], 'method' => 'DELETE']) !!}
                                                        <button type="submit" class="btn btn-danger">Verwijder</button>
                                                    {!! Form::close() !!}
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </ol>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info" data-dismiss="modal">Sluiten</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <br>
            <div class="form-group">
                <div class="col-xs-6">
                    <label for="voornaam"><h4>Voornaam:</h4></label>
                    <h5>{{ $user->first_name }}</h5>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-6">
                    <label for="achternaam"><h4>Achternaam:</h4></label>
                    <h5>{{ $user->last_name }}</h5>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-6">
                    <label for="e-mail"><h4>E-mail:</h4></label>
                    <h5>{{ $user->email }}</h5>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-6">
                    <label for="adres"><h4>Adres:</h4></label>
                    <h5>{{ $user->address }}</h5>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-6">
                    <label for="postcode"><h4>Postcode:</h4></label>
                    <h5>{{ $user->zipcode }}</h5>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-6">
                    <label for="Stad"><h4>Stad:</h4></label>
                    <h5>{{ $user->city }}</h5>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-6">
                    <label for="telefoonnummer"><h4>Telefoonnummer:</h4></label>
                    <h5>{{ $user->phone }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endauth

@stop
