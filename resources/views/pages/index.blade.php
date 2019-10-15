@extends('layouts.app')
    
@section('content')  
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		<!-- Styles -->
        <style>
		@import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');
		*{
			margin:0;
		}
       

		body{
			font-family: 'Roboto', sans-serif;
			background-color: #DEDEDE;
		}
		
		.carousel{
			max-height:90vh;
			background-image:url('{{url('/public/images/slide1.jpg')}}');
		}
		
		.desc{
			background-color:#474545b5;
			padding:25px;
			border-radius:5px;
			box-shadow: 1px 15px 30px -10px rgba(0,0,0,0.5);
			top: 50%;
			left: 5%;
			width: 450px;
			height: 300px;
			transform:translateY(-50%);
    
		}
		
		.desc h5{
			font-family: 'Nunito', sans-serif;
			padding: 50px 0 25px;
			font-size:1.75rem;
		}
		
		.desc p{
			font-family: 'Nunito', sans-serif;
			padding: 10px 0;
			font-size:1rem;
		}
		
		.slides{
			margin:0;
			position: absolute;
			right: 0;
			bottom: 0;
			left: 5%;
			top: 65%;
			width: 450px;
			
		}
		.carousel-control-prev, .carousel-control-next{
			display:none;
		}
		.img-responsive{
			width: 200px;
			height: 90vh;
			object-fit: cover;
		}
		
		 .main{
			width:100%;
			height:100vh; 
			background:#eee;
		}
		.login-box {
			width: 400px;
			height: 600px;
			background: #474545;
			position: absolute;
			z-index: 1003;
			top: 50%;
			left: 50%;
			box-shadow: 1px 15px 30px -10px rgba(0,0,0,0.5);
			border-radius: 5px;
			transform: translate(-50%,-50%);
		}
		.login-div {
			text-align:center;
			padding:45px 25px 35px;
		}
		
		#login-slika {
			width: 80%;
		}
		
		.login-upper {
			position: relative;
			float: left;
			width: 400px;
			min-height: 320px;
			height:auto;
			background: rgba(254,96,93,1);
			background: -moz-linear-gradient(top, rgba(254,96,93,1) 0%, rgba(242,67,65,1) 74%, rgba(242,67,65,1) 100%);
			background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(254,96,93,1)), color-stop(74%, rgba(242,67,65,1)), color-stop(100%, rgba(242,67,65,1)));
			background: -webkit-linear-gradient(top, rgba(254,96,93,1) 0%, rgba(242,67,65,1) 74%, rgba(242,67,65,1) 100%);
			background: -o-linear-gradient(top, rgba(254,96,93,1) 0%, rgba(242,67,65,1) 74%, rgba(242,67,65,1) 100%);
			background: -ms-linear-gradient(top, rgba(254,96,93,1) 0%, rgba(242,67,65,1) 74%, rgba(242,67,65,1) 100%);
			background: linear-gradient(to bottom, rgba(254,96,93,1) 0%, rgba(242,67,65,1) 74%, rgba(242,67,65,1) 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fe605d', endColorstr='#f24341', GradientType=0 );
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fe605d', endColorstr='#f24341', GradientType=0 );
			padding:15px 0;
			left: 0px;
			color: #fff;
			text-align: center;
			box-shadow: 1px 1px 20px -5px rgba(0,0,0,0.5);
			border-radius: 3px;
			transition: all 0.5s;
			transition-delay: 1.3s;
		}
		.login-upper h1 {
			font-size: 2rem;
		}
		
		.login-box > .login-upper {
			width: 450px;
			left: -25px;
		}
		.register-link{
			width:95%;
			margin:auto;
			margin-top:10px;
		}
		.register-link a{
			text-transform:uppercase;
			color:#fff;
			transition:all 0.5s;
		}
		.register-link a:hover{
			color:#474545;
			text-decoration:none;
			transform:scale(1.5);
		}
		
		.help-block{
			font-size:10px;
		}
		
		@media only screen and (max-width: 450px){
			.login-box {
				width: 280px;
				height: 400px;
			}
			.login-upper {
				width: 280px;
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
			
		<div class="ml0 mr0 row " style="margin:0">	
		<div id="carouselExampleIndicators" class="carousel slide carousel-fade shadow-box" data-ride="carousel" data-interval="4000" data-pause="false">
			<ol class="carousel-indicators slides">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
			  <img class="img-responsive d-block w-100" src="{{url('/public/images/slide1.jpg')}}" alt="First slide">
			  <div class="carousel-caption d-none d-md-block desc">
				<h5>Stop writing down your shopping lists</h5>
				<p>Save paper and create shopping lists using our app</p>
			  </div>
			</div>
			
			<div class="carousel-item">
			  <img class="img-responsive  d-block w-100" src="{{url('/public/images/slide1.jpg')}}" alt="Second slide">
			  <div class="carousel-caption d-none d-md-block desc">
				<h5>Stop writing down your shopping lists</h5>
				<p>Access your list anytime - anywhere. Just log in app with your account</p>
			  </div>
			</div>
			<div class="carousel-item">
			  <img class="img-responsive  d-block w-100" src="{{url('/public/images/slide1.jpg')}}" alt="Third slide">
			  <div class="carousel-caption d-none d-md-block desc">
				<h5>Stop writing down your shopping lists</h5>
				<p>Create new lists and manage with existing</p>
			  </div>
			</div>
		  </div>
		  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		  </a>
		</div>	
		
		<div class="row boxes-wrapper">
			<div class="col-sm-12 col-md-4 wow zoomIn">
				<div class="text-box">
					<h4><i class="fas fa-clipboard-list"></i></h4>
					<h6>Create your shopping lists</h6>
					<p>
					<br>
					You can add your new items on the list, 
					or you can select an item from our suggestions and add it to your list.
					
					</p>
					
				</div>
			</div>
			
			<div class="col-sm-12 col-md-4 wow zoomIn">
				<div class="text-box">
					<h4><i class="fas fa-layer-group"></i></h4>
					<h6>Group list items</h6>
					<p>
					<br>
					Fruits, dairy, cosmetics, clothes... You name it. You can group items on your list by category, making it organized and easier to use.
					</p>
				</div>
			</div>
			
			<div class="col-sm-12 col-md-4 wow zoomIn">
				<div class="text-box">
					<h4><i class="fas fa-tasks"></i></h4>
					<h6>Check bought items</h6>
					<p>
					<br>
					Found what you need? Then cross it of your list and continue to shop.
					<br>
					</p>
				</div>
			</div>
		
		</div>
		
		<!-- Parralax effect -->
		<section id="about">
			<div class="about-wrapper">
			</div>	
		</section>
		
		<div class="row py-5">
			<div class="offset-2 col-md-8 col-sm-12 about-text" >
				<h3 class="wow fadeInLeft"> Find out a little bit more about us</h3>
				<p class="wow fadeInRight">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
				Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor 
				in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
				Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
				<p class="wow fadeInLeft">
				Id aliquet risus feugiat in. Auctor neque vitae tempus quam pellentesque nec nam. Egestas integer eget aliquet nibh praesent. 
				Porta non pulvinar neque laoreet suspendisse interdum consectetur libero id.
				Morbi non arcu risus quis varius quam quisque. Quisque non tellus orci ac auctor augue mauris augue neque. Non arcu risus quis 
				varius quam quisque id. Magnis dis parturient montes nascetur ridiculus. Ultricies mi quis hendrerit dolor. Nibh venenatis cras 
				sed felis eget. Est velit egestas dui id. Venenatis cras sed felis eget velit aliquet sagittis id consectetur. Quis blandit turpis
				cursus in hac habitasse platea. Nisl pretium fusce id velit. Neque aliquam vestibulum morbi blandit. Est sit amet facilisis magna. Sed lectus vestibulum mattis ullamcorper velit sed ullamcorper. Morbi quis commodo odio aenean sed adipiscing. Tortor at auctor urna nunc id cursus metus.
				</p>
				<p class="wow fadeInRight">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
				Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor 
				in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
				Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>	
	
			</div>
		</div>
		
			
			<div class="login-box" style="display:none">
				<span class="close-btn" style="float:right;color:#fff" onclick="showloginform()"><i class="far fa-times-circle"></i></span>
				<div class="login-div">
					<img id="login-slika" src="{{url('/public/images/list-logo.png')}}" >
				</div>
				<div class="login-upper">
				   <h1>Welcome to Shopping List</h1>
					<p>Please log to your profile</p>
					<form method="post" action="{{ route('login') }}" >
						 {{ csrf_field() }}
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-default">Username</span>
							</div>
							<input type="text" name="email" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{{ old('email') }}">
						</div>
						@if ($errors->has('email'))
							<div class="col-sm-12">
								<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
							</div>
                        @endif
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-default">Password</span>
							</div>
							<input type="password"  name="password" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
						</div>
						 @if ($errors->has('password'))
							<div class="col-sm-12">
								<span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
							</div>
						@endif
								 
						<input type="submit" class="btn btn-primary" value="Login" />								 
					</form>	
					
					<p class="register-link">You don't have a profile? <a href="{{ route('register') }}">Register</a> in few steps and use our app</p>
				</div>
			</div>	
		</div>		
		<script>
		function showloginform(){
			$('html,body').animate({
				scrollTop: 0
			}, 500);

			$('.login-box').slideToggle();
		}
		</script>
		
		<footer>
			<div class="contact">
				<div class="row">
					<div class="col-md-5 wow fadeInLeft" style="text-align:center">
						<img id="footer-slika" src="{{url('/public/images/list-logo.png')}}" >
					</div>
				
				
				
				<div class="col-md-3 wow fadeInUp" id="member-data">
					<h4>MEMBER AREA</h4>
					<div class="row">
						<div class="col-md-6"><button class="btn-main"><a style="cursor:pointer" onclick="showloginform()">{{ __('Login') }}</a></button></div>
						<div class="col-md-6"><button class="btn-main"><a href="{{ route('register') }}">{{ __('Register') }}</a></button></div>
					</div>
				</div>
				
				<div class="col-md-4 wow fadeInRight" id="cont-data">
					<h4>Contact us</h4>
					<div class="row">
						<div class="col-md-12 py-3">
							<p style="float:left;width:20%"> 
								<a href="mailto:email@site.com"><i class="fas fa-envelope"></i></a>
							</p>
							<p style="float:left;width:20%">
								<a href="tel:00000000"><i class="fas fa-phone"></i></a>
							</p>
							<p style="float:left;width:20%"> 
								<a href="#" target="_blank"><i class="fab fa-facebook"></i></a> 
							</p>
							<p style="float:left;width:20%"> 
								<a href="#" target="_BLANK"><i class="fab fa-twitter"></i></a>
							</p>
							<p style="float:left;width:20%"> 
								<a href="#" target="_blank"><i class="fab fa-instagram" ></i></a> 
							</p>
						</div>
					</div>
				</div>
				
				<div class="col-sm-12" style="text-align:center"><i class="fa fa-copyright"> <?php echo date("Y"); ?></i> <a href="#">Shopping cart</a> </div>
				
			</div>
		</div>

    </footer>
		
@endsection