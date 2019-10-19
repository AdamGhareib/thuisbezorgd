@extends('layouts.header')

@section('content')

<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-3">
            <div class="text-center">
                <br>
            {!! Form::open(['route' => ['restaurant.update', $restaurant->id], 'method' => 'PATCH', 'files' => true]) !!}
                <img src="{{ asset('/uploads/avatars/'. $restaurant->avatar) }}" style="width: 150px; height: 150px; display: block; margin-left: auto; margin-right: auto;" class="card-img-top" alt="Card image cap">
                <input type="file" name="avatar">
            </div>
            <br>
            <div class="card">
                <h5 class="card-header">Over Ons</h5>
                <div class="card-body">
                    {!! Form::text('biography', $restaurant->biography, ['class' => 'form-control', 'placeholder' => 'biography status','autocomplete' => 'off']); !!}
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-info">save</button>
        </div>



        <div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Over Ons</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="show-tab" data-toggle="tab" href="#show" role="tab" aria-controls="show" aria-selected="true">Alle Producten</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-tab" data-toggle="tab" href="#product" role="tab" aria-controls="product" aria-selected="true">Voeg Een Product Toe</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="col-sm-9">
                        <br>
                            <label for="name"><h4>Name:</h4></label>
                            {!! Form::text('name', $restaurant->name, ['class' => 'form-control', 'placeholder' => 'naam','autocomplete' => 'off']); !!}
                            <br>
                            <label for="kvk"><h4>KVK:</h4></label>
                            {!! Form::text('kvk', $restaurant->kvk, ['class' => 'form-control', 'placeholder' => 'KVK','autocomplete' => 'off']); !!}
                            <br>
                            <label for="zipcode"><h4>Postcode:</h4></label>
                            {!! Form::text('zipcode', $restaurant->zipcode, ['class' => 'form-control', 'placeholder' => 'postcode','autocomplete' => 'off']); !!}
                            <br>
                            <label for="city"><h4>Stad:</h4></label>
                            {!! Form::text('city', $restaurant->city, ['class' => 'form-control', 'placeholder' => 'stad','autocomplete' => 'off']); !!}
                            <br>
                            <label for="phone"><h4>Telefoonnummer:</h4></label>
                            {!! Form::text('phone', $restaurant->phone, ['class' => 'form-control', 'placeholder' => 'telefoonnummer','autocomplete' => 'off']); !!}
                            <br>
                            <label for="email"><h4>E-mail:</h4></label>
                            {!! Form::text('email', $restaurant->email, ['class' => 'form-control', 'placeholder' => 'e-mail','autocomplete' => 'off']); !!}
                            <br>
                            <label for="is_open"><h4>Open:</h4></label>
                            {!! Form::time('is_open', $restaurant->is_open, ['class' => 'form-control', 'placeholder' => '','autocomplete' => 'off']); !!}
                            <br>
                            <label for="is_closed"><h4>Sluitingstijd:</h4></label>
                            {!! Form::time('is_closed', $restaurant->is_closed, ['class' => 'form-control', 'placeholder' => '','autocomplete' => 'off']); !!}
                            <br>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="tab-pane fade show" id="show" role="tabpanel" aria-labelledby="show-tab">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Naam</th>
                                <th>Categorie</th>
                                <th>Prijs</th>
                                <th>Verwijderen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $consumables = $restaurant->consumables()->orderBy('category', 'asc')->get()
                            @endphp
                            @foreach($consumables as $consumable)
                                <tr>
                                    <td>{{$consumable->id}}</td>
                                    <td><img style="width: 32px; height: 32px;" class="img-thumbnail" alt="product foto" src="{{asset('uploads/avatars')}}/{{$consumable->avatar}}"></td>
                                    <td>{{$consumable->title}}</td>
                                    @if($consumable->category == 1)
                                        <td>Hoofdgerecht</td>
                                    @elseif($consumable->category == 2)
                                        <td>Bijgerecht</td>
                                    @else
                                        <td>Dranken</td>
                                    @endif
                                    <td>€{{$consumable->price}},-</td>
                                    <td>
                                        {!! Form::open(['route' => ['consumable.destroy', $consumable->id], 'method' => 'DELETE']) !!}
                                            <button  style="margin-left:  5px;" type="submit" class="float-md-right btn btn-danger">Verwijderen</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade show" id="product" role="tabpanel" aria-labelledby="product-tab">
                    {!! Form::open(['route' => 'consumable.store', 'method' => 'POST', 'files' => true]) !!}


                    <label for="title">Naam</label>
                    <div class="input-group mb-3">


                      {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' =>
                      'Product naam','autocomplete' => 'off']); !!}
                    </div>
                    <label for="price">Prijs</label>
                    <div class="input-group mb-3">


                      {!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Prijs','autocomplete' => 'off']); !!}
                    </div>
                    <label for="price">Categorie</label>
                    {!! Form::select('category',['1' => 'Hoofdgerecht','2'=>'Bijgerecht','3'=>'Dranken'],null, ['class'=>'form-control','placeholder'=>'Selecteer categorie']) !!}
                    <br>
                    <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
                    <br>
                    <input type="file" name="avatar">
                    <br>
                    <br>
                    <button type="submit" class="btn btn-success">Aanmaken</button>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
