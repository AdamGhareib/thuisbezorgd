<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/sfj0qkbtf1uatbaq8ng8miqlkvptidebmmbmq7l1luyksvb2/tinymce/5/tinymce.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
</head>
<body style="background-color: #ffffff !important">
	<header>
		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FF8000;">
		  	<a class="navbar-brand" href="{{ asset('home') }}">
		    	<img src="{{asset('/uploads/avatars/thuisbezorgd.png')}}" width="70" height="40" alt="">
		  	</a>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		    	<div class="navbar-nav">
		      		<a class="nav-item nav-link active" href="{{ asset('home') }}">Home <span class="sr-only">(current)</span></a>
		    	</div>
		    	<div class="navbar-nav">
		      		<a class="nav-item nav-link active" href="{{ asset('restaurant') }}">Alle Restaurants <span class="sr-only">(current)</span></a>
		    	</div>
		  	</div>
		  	{{-- <div class="form-inline w-100 d-none d-md-block ml-2">
                <div class="form-group">
                    <input type="text" class="form-control form-control-sm rounded-pill search border-0 px-3 w-100" name="restaurant" id="restaurant" autocomplete="off" placeholder="search">
                    <div id="restaurantList"></div>
                </div>
                {{ csrf_field() }}
            </div> --}}
		  	<ul class="navbar-nav d-none d-md-block">
	            @guest
	                <li class="nav-item">
	                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
	                </li>
	                @if (Route::has('register'))
	                    <li class="nav-item">
	                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
	                    </li>
	                @endif
	            @else
	                <li class="nav-item dropdown">
	                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="position: relative; padding-left: 50px;">
	                        <img src="{{ asset('/uploads/avatars/'. Auth::user()->avatar) }}" style="width: 32px; height: 32px; position: absolute; left: 10px; top: 4px; border-radius: 50%;">
	                                {{ Auth::user()->first_name }} <span class="img-fluid rounded-circle"></span>
	                    </a>

	                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
	                        <a class="dropdown-item" href="{{ route('profile') }}/">Profile</a>
	                        <a class="dropdown-item" href="{{ route('logout') }}"
	                           onclick="event.preventDefault();
	                                         document.getElementById('logout-form').submit();">
	                            {{ __('Logout') }}
	                        </a>

	                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                            @csrf
	                        </form>
	                    </div>
	                </li>
	            @endguest
	        </ul>
		</nav>
	</header>
@yield('content')

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<script>
$(document).ready(function(){
    $('#restaurant').keyup(function(){
        var query = $(this).val();
        if(query != '') {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{ route('autocomplete.fetch') }}",
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                    $('#restaurantList').fadeIn();
                        $('#restaurantList').html(data);
                }
            });
        }
        else {
            // remove autocomplete block
            $('#restaurantList').hide();
        }
    });
    $(document).on('click', 'li', function(){
        $('#restaurant').val($(this).text());
        $('#restaurantList').fadeOut();
    });
});
</script>
</body>
</html>
