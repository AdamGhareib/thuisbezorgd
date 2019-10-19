@extends('layouts.header')

@section('content')

<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-3">
            <div class="text-center">
            	<br>
            {!! Form::open(['route' => ['profile.update', Auth::user()->id], 'method' => 'PUT', 'files' => true]) !!}
                <img src="{{ asset('/uploads/avatars/'. $user->avatar) }}" style="width: 150px; height: 150px; border-radius: 50%; display: block; margin-left: auto; margin-right: auto;" class="card-img-top" alt="Card image cap">
                <input type="file" name="avatar">
            </div>
            <br>
            <button type="submit" class="btn btn-info">save</button>
        </div>
    	<div class="col-sm-9">
    		<br>

            	<label for="first_name"><h4>Voornaam:</h4></label>
	    		{!! Form::text('first_name', $user->first_name, ['class' => 'form-control', 'placeholder' => 'voornaam','autocomplete' => 'off']); !!}
	    		<br>
	    		<label for="last_name"><h4>Achternaam:</h4></label>
	    		{!! Form::text('last_name', $user->last_name, ['class' => 'form-control', 'placeholder' => 'achternaam','autocomplete' => 'off']); !!}
	    		<br>
	    		<label for="e-mail"><h4>E-mail:</h4></label>
	    		{!! Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'email','autocomplete' => 'off']); !!}
	    		<br>
	    		<label for="adres"><h4>Adres:</h4></label>
	    		{!! Form::text('address', $user->address, ['class' => 'form-control', 'placeholder' => 'adres','autocomplete' => 'off']); !!}
	    		<br>
	    		<label for="email"><h4>Postcode:</h4></label>
	    		{!! Form::text('zipcode', $user->zipcode, ['class' => 'form-control', 'placeholder' => 'postcode','autocomplete' => 'off']); !!}
	    		<br>
                <label for="city"><h4>Stad:</h4></label>
                {!! Form::text('city', $user->city, ['class' => 'form-control', 'placeholder' => 'stad','autocomplete' => 'off']); !!}
                <br>
                <label for="telefoonnummer"><h4>Telefoonnummer:</h4></label>
                {!! Form::text('phone', $user->phone, ['class' => 'form-control', 'placeholder' => 'telefoonnummer','autocomplete' => 'off']); !!}
                <br>
            {!! Form::close() !!}
            <p>
			    {!! Form::open(['route' => ['profile.destroy', $user->id], 'method' => 'DELETE']) !!}
				<button type="submit" class="btn btn-danger">delete profile</button>
				{!! Form::close() !!}
			</p>
        </div>
    </div>
</div>

@endsection
