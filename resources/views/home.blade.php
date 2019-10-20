@extends('layouts.app')

@section('content')
<div class="container py-5">
	<?php
	/* Check to see if loged user is not an admin	*/
	if((Auth::user()->usertype == 'user')){
            // return redirect('/posts')->with('error', 'Unauthorized Page');
        }
	?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
	</div>
	<div class="row justify-content-center py-5">	
		
		<div class="col-sm-12 col-md-3 col-lg-3">
			<div onclick="window.location.href='users'" class="boxq">
				<i style="font-size:50px" class="fas fa-users"></i>
				<p>Manage registrated users</p>
			</div>
						
		</div>
		
		<div class="col-sm-12 col-md-3 col-lg-3">
			<div onclick="window.location.href='categories'" id="categoriesBtn" class="boxq">
				<i style="font-size:50px" class="fas fa-th-large"></i>
				<p>Manage categories</p>
			</div>		
		</div>

		
		<div class="col-sm-12 col-md-3 col-lg-3">
			<div onclick="window.location.href='articles'" class="boxq">
				<i style="font-size:50px" class="fas fa-circle"></i>
				<p>Manage items</p>
			</div>
						
		</div>
		
		<div class="col-sm-12 col-md-3 col-lg-3">
			<div onclick="window.location.href='lists'" class="boxq">
				<i style="font-size:50px" class="fa fa-list-alt"></i>
				<p>Manage lists</p>
			</div>			
		</div>
					  
    </div>
</div>
@endsection
