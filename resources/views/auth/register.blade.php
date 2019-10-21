<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{config('app.name','Shopping List')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      
		<link rel="stylesheet" href="{{ url('/public/assets/fonts/fontawesome/css/all.css') }}">
		<!-- Styles -->
        <style>
		@import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');
		*{
			margin:0;
		}
       

		body{
			font-family: 'Roboto', sans-serif;
			background-color: #474545;
		}
		 .main{
			width:60%;
			height:60vh; 
			background: rgba(254,96,93,1);
			background: -moz-linear-gradient(top, rgba(254,96,93,1) 0%, rgba(242,67,65,1) 74%, rgba(242,67,65,1) 100%);
			background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(254,96,93,1)), color-stop(74%, rgba(242,67,65,1)), color-stop(100%, rgba(242,67,65,1)));
			background: -webkit-linear-gradient(top, rgba(254,96,93,1) 0%, rgba(242,67,65,1) 74%, rgba(242,67,65,1) 100%);
			background: -o-linear-gradient(top, rgba(254,96,93,1) 0%, rgba(242,67,65,1) 74%, rgba(242,67,65,1) 100%);
			background: -ms-linear-gradient(top, rgba(254,96,93,1) 0%, rgba(242,67,65,1) 74%, rgba(242,67,65,1) 100%);
			background: linear-gradient(to bottom, rgba(254,96,93,1) 0%, rgba(242,67,65,1) 74%, rgba(242,67,65,1) 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fe605d', endColorstr='#f24341', GradientType=0 );
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fe605d', endColorstr='#f24341', GradientType=0 );
			position: absolute;
			z-index: 1003;
			top: 50%;
			left: 50%;
			box-shadow: 1px 15px 30px -10px rgba(0,0,0,0.5);
			border-radius: 5px;
			transform: translate(-50%,-50%);
			padding:25px;
		}
		.login-div {
			text-align:center;
			padding:45px 25px 35px;
		}
		
		#login-slika {
			height:80px;
		}
		
		.login-upper {
			position: relative;
			margin:auto;
			width: 800px;
			min-height: 320px;
			height:auto;
			padding:15px 0;
			left: 0px;
			color: #fff;
			text-align: center;
			
		}
		.login-upper h1 {
			font-size: 2rem;
			margin-bottom:45px;
		}

		.login-link{
			width:95%;
			margin:auto;
			margin-top:30px;
		}
		.login-link a{
			text-transform:uppercase;
			color:#fff;
			transition:all 0.5s;
		}
		.login-link a:hover{
			color:#474545;
			text-decoration:none;
			transform:scale(1.5);
		}
		
		.help-block{
			font-size:12px;
		}
		
		@media only screen and (max-width: 450px){
			.main{
				width:auto;
				min-height:75vh;
				height:auto; 
				top: 60%;
			}
			.login-box {
				width: 280px;
				height: 400px;
			}
			.login-upper {
				width: 280px;
			}
			.login-upper h1{
				font-size:1.4rem;
				margin-bottom: 25px;
			}
			
			.login-box > .login-upper {
				width: 300px;
				left: -10px;
			}
			
			#login-slika {
				width: 80%;
			}
		}
		.input-group{
			width: 90%;
			margin: auto;
		}
        </style>
    </head>
    <body>
		<div class="login-div">
				<img id="login-slika" src="{{url('/public/images/list-logo.png')}}" >
			</div>
		<div class="main">
			
			<div class="login-box">
				
				<div class="login-upper">
				   <h1>Create a new profile to start using our application.</h1>
					<form method="post" id="registerForm" name="registerForm" action="{{ route('register') }}" >
						 {{ csrf_field() }}
						@error('name')
							<div class="col-sm-12">
								<span class="help-block">
									<strong>{{ $message }}</strong>
								</span>
							</div>
                        @enderror
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-user"></i></span>
							</div>
							<input id="name" name="name" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" 
							@error('name') value="{{ old('name') }}"  @enderror required placeholder="Your fullname">
						</div>
						
						@error('email')
							<div class="col-sm-12">
								<span class="help-block">
									<strong>{{ $message }}</strong>
								</span>
							</div>
                        @enderror
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-at"></i></span>
							</div>
							<input id="email" name="email" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" 
							@error('email') value="{{ old('email') }}"  @enderror required placeholder="{{ __('E-Mail Address') }}">
						</div>
						
						 @error('password')
							<div class="col-sm-12">
								<span class="help-block">
									<strong>{{ $message }}</strong>
								</span>
							</div>
						@enderror
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-lock"></i></span>
							</div>
							<input type="password" name="password" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="{{ __('Password') }}">
						</div>
						
						 @error('password')
							<div class="col-sm-12">
								<span class="help-block">
									<strong>{{ $message }}</strong>
								</span>
							</div>
						@enderror
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-lock"></i></span>
							</div>
							<input id="password-confirm" type="password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
						</div>
						
								 
						<input type="submit" class="btn btn-primary" value="{{ __('Register') }}" />								 
					</form>	
					
					
					
					<p class="login-link">Already have a profile? <a href="homepage">Login</a> and start using our app.</p>
				</div>
			</div>	
		</div>
		<script src="{{ asset('public/assets/js/jquery-3.3.1.min.js') }}" ></script>
		<script src="{{ asset('public/assets/js/popper.min.js') }}" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="{{ asset('public/assets/js/js/bootstrap.min.js') }}" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>
