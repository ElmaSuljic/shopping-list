@extends('layouts.app')

@section('content')
    <div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header" style="background: url('{{url('/public/images/list-header.jpg')}}');">
            <h3>Shopping List</h3>
        </div>

        <ul class="list-unstyled components">
            <p>Welcome to Shopping list, <br>  {{ Auth::user()->name }} </p>
			<li class="active">
                <a href="{{url('dashboard')}}">Home</a>
            </li>
            <li>
                <a href="{{url('lists/create')}}">Add new list</a>
            </li>
            <li>
                <a href="{{url('lists')}}">Your lists</a>
            </li>
        </ul>
    </nav>
	<div id="content">
		<div class="row">
		<div class="col-md-8 offset-md-2">

        <div class="card card-cascade wider reverse my-3">
          <div class="view view-cascade overlay">
            <img src="{{url('/public/images/slide4.jpeg')}}" alt="" class="card-img-top medium-image">
            <a>
              <div class=""></div>
            </a>
          </div>

          <!--Post data-->
          <div class="card-body card-body-cascade text-center">
            <h2>
              <a class="font-weight-bold">Create your custom shopping list.</a>
            </h2>
            <p>Access then anytime</p>

            <!--Social shares-->
            <div style="font-size:12px">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Elit duis tristique sollicitudin nibh sit. Eget lorem dolor sed viverra ipsum nunc. Neque convallis a cras semper auctor. Vitae tortor condimentum lacinia quis. Tristique risus nec feugiat in. Ac felis donec et odio pellentesque. Commodo elit at imperdiet dui accumsan sit. Viverra mauris in aliquam sem fringilla ut morbi tincidunt augue. Sed egestas egestas fringilla phasellus faucibus scelerisque. Leo integer malesuada nunc vel risus. Libero justo laoreet sit amet cursus sit amet dictum sit. Egestas diam in arcu cursus euismod. Dictumst quisque sagittis purus sit amet volutpat.
</p><p>
 A scelerisque purus semper eget duis at tellus at. Congue nisi vitae suscipit tellus mauris. Eget egestas purus viverra accumsan in nisl nisi scelerisque. Nisi scelerisque eu ultrices vitae auctor eu augue. Ac tortor vitae purus faucibus ornare suspendisse sed. Id velit ut tortor pretium. Magna sit amet purus gravida quis blandit turpis cursus. Blandit cursus risus at ultrices mi tempus imperdiet.</p>
              
			<div class="col-md-12"><button class="btn-main-red"><a href="{{url('lists')}}">{{ __('See your lists') }}</a></button></div>
            </div>
     

          </div>
        </div>

      </div>
    </div>
	</div>

</div> 

<script>
$(document).ready(function () {
	$('#activate-sidebar').addClass('sidebar-help');
	$('.navbar-toggler').addClass('navbar-help');
});
</script>
@endsection
