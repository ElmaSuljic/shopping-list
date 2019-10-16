@extends('layouts.app')

@section('content')
<div class="py-5">
<?php 
	$registrated = $data['registrated'];
	$administrators = $data['administrators']; 
?>
	<?php
	if(isset($helperror)){
		echo 'ddd';
		echo '<script>showcreateform();</script>';
	}
	?>
	
    <div class="row">
		<div class="col-sm-12 col-md-10 offset-md-1">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
						aria-selected="true">Registrated users</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
					aria-selected="false">Administrators</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active py-3" id="home" role="tabpanel" aria-labelledby="home-tab">
					<div class="row">
						<div class="col-md-8">
							<div class="card">
								<div class="card-header">
									Registrated users
								</div>

								<div class="card-body">
								@if(count($registrated) > 0)   
								<table class="table">
									<thead class="thead-dark">
										<tr>
										<th scope="col">#</th>
										<th scope="col">Name</th>
										<th scope="col">Email</th>
										<th scope="col">Make administator</th>
										<th scope="col">Delete</th>
										</tr>
									</thead>
									<tbody>
									@foreach($registrated as $art)
										<tr>
											<th scope="row">1</th>
											<td>{{$art->name}}</td>
											<td>{{$art->email}}</td>
											<td>
												<!--
												<button class="btn btn-primary cursor-pointer">
													<a style="color:#fff" href="articles/{{$art->articleId}}/edit">Edit</a> 
												</button> 
												-->
												{!!Form::open(['action' => ['UsersController@update', $art->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
													{{Form::hidden('_method','PUT')}}
													{{Form::hidden('makeadmin', 'true')}}
													{{Form::submit('Confirm', ['class' => 'btn btn-success'])}}
												{!!Form::close()!!}
											</td>
											<td>
											{!!Form::open(['action' => ['UsersController@destroy', $art->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
												{{Form::hidden('_method', 'DELETE')}}
												{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
											{!!Form::close()!!}
											</td>
										</tr>
									@endforeach
								  </tbody>
								</table>
								@else
									<p>No registrated users.</p>
									
								@endif		
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="tab-pane fade py-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									Administrators
									<span class="btn btn-primary cursor-pointer" style="float:right;" onclick="showcreateform()">
										Add new administator
									</span>
								</div>

								<div class="card-body">
								@if(count($administrators) > 0)   
								<table class="table">
									<thead class="thead-dark">
										<tr>
										<th scope="col">#</th>
										<th scope="col">Name</th>
										<th scope="col">Email</th>
										<th scope="col">Edit</th>
										<th scope="col">Delete</th>
										</tr>
									</thead>
									<tbody>
									@foreach($administrators as $art)
										<tr>
											<th scope="row">1</th>
											<td>{{$art->name}}</td>
											<td>{{$art->email}}</td>
											<td>
												<!--
												<button class="btn btn-primary cursor-pointer">
													<a style="color:#fff" href="articles/{{$art->articleId}}/edit">Edit</a> 
												</button> 
												-->
												
												<button class="btn btn-primary cursor-pointer" onclick="showeditform({{$art->id}})">
													Edit
												</button> 
												
											</td>
											<td>
											{!!Form::open(['action' => ['UsersController@destroy', $art->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
												{{Form::hidden('_method', 'DELETE')}}
												{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
											{!!Form::close()!!}
											</td>
										</tr>
									@endforeach
								  </tbody>
								</table>
								@else
									<p>No registrated users.</p>
									
								@endif		
								</div>
							</div>
						</div>
						<div class="col-md-6" id="createform" style="display:none">
							<h4 class="py-2">Add new Administrator</h4>
							{!! Form::open(['action' => 'UsersController@store', 'method' => 'POST']) !!}
							{{ csrf_field() }}
							
							{{Form::hidden('addadmin','true')}}
							
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-user"></i></span>
								</div>
								<input id="name" name="name" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" 
								value="" required placeholder="Fullname">
							</div>
							
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-at"></i></span>
								</div>
								<input id="email" name="email" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" 
								value="" required placeholder="{{ __('E-Mail Address') }}">
							</div>
							
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-lock"></i></span>
								</div>
								<input type="password" name="password" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="{{ __('Password') }}">
							</div>
							
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-lock"></i></span>
								</div>
								<input id="password-confirm" type="password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
							</div>
							<div style="text-align:center">
								{{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
							</div>
							{!! Form::close() !!}
						</div>
						
						
						<div class="col-md-6" id="editform" style="display:none">
							<h4 class="py-2">Edit Administrator</h4>
							{!! Form::open(['action' => ['UsersController@update', 1], 'id' => 'formeditaction', 'method' => 'POST']) !!}
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-user"></i></span>
									</div>
									{{Form::text('name', '', ['class' => 'form-control', 'id' => 'nameedit', 'placeholder' => 'Fullname'])}}
								</div>
								
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-at"></i></span>
									</div>
									{{Form::text('email', '', ['class' => 'form-control', 'id' => 'emailedit', 'placeholder' => 'Email'])}}
								</div>
								
								<div class="custom-control custom-checkbox">
									<input type="checkbox" name="isadmin" class="custom-control-input" id="isadmin">
									<label class="custom-control-label" for="isadmin">Administator</label>
								</div>
								{{Form::hidden('editadmin', 'true')}}
								{{Form::hidden('_method','PUT')}}
								<div style="text-align:center">
									{{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
								</div>
							{!! Form::close() !!}
							</div>
						</div>
				</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
	<script>

	function showcreateform(){
		$('html,body').animate({
			scrollTop: 0
		}, 500);

		$('#createform').slideToggle();
		$('#editform').css('display','none');
	}
	function showeditform(id){
		$('#editform').css('display','block');
		$('#createform').css('display','none');
		$.ajax({
			url: 'users/'+id,
			type: 'get',
			dataType: 'json',
			contentType: 'application/json; charset=utf-8',
			success:function(data){
				$('#nameedit').val(data.name);
				$('#emailedit').val(data.email);
				var prevaction = $('#formeditaction').attr('action');
				var res = prevaction.split("/users");
				var newaction = res[0]+'/users/'+data.id;
				$('#formeditaction').attr('action', newaction);
				if(data.admin == 'true'){
					$("#isadmin").prop('checked', true);
				}
				
			}, error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr.status);
				console.log(thrownError);
			  }
		  })

	}



	</script>

@endsection
