<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
	<script src="{{ asset('public/assets/js/jquery-3.3.1.min.js') }}" ></script>
	<script src="{{ asset('public/assets/js/toastr.min.js') }}" ></script>
	<script src="{{ asset('public/assets/js/sweetalert.min.js') }}" ></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('public/assets/css/app.css') }}" rel="stylesheet"> 
	<link href="{{ asset('public/assets/css/toastr.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ url('/public/assets/fonts/fontawesome/css/all.css') }}">
	<link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md bg-black ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="logo-img" src="{{url('/public/images/logo-sl.png')}}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon" style="color:#fff"><i class="fas fa-chevron-circle-down"></i></span>
                </button>
				<span id="activate-sidebar" onclick="$('#sidebar').toggleClass('active');"><i class="fas fa-bars"></i></span>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
						@guest

                        @else
							@if (Auth::user()->usertype == 'user')
                           
							@else
								<li class="nav-item">
                                    <a class="nav-link" href="{{ url('home') }}">{{ __('Dashboard') }}</a>
                                </li>
                            @endif
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" onclick="showloginform()">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else							
							
							
							
                            <li class="nav-item dropdown">
								
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									
                                    <a class="dropdown-item" href="{{ route('logout') }}" style="color:black !important;"
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
                </div>
            </div>
        </nav>

        <main class="">
			<div class="offset-4 col-md-4 col-sm-12">
			@include('include.messages')
			</div>
            @yield('content')
        </main>
    </div>
	<script src="{{ asset('public/assets/js/wow.min.js') }}" ></script>	
	<script src="{{ asset('public/assets/js/popper.min.js') }}" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="{{ asset('public/assets/js/js/bootstrap.min.js') }}" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script type="text/javascript">
		new WOW().init();
		
		$.ajaxSetup({
		  headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
		
		if (screen.width < 800) {
			$('.table').addClass('table-responsive');
		} 
	</script>
</body>
</html>
