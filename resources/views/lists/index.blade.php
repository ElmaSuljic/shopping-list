@extends('layouts.app')

@section('content')
	<?php
	/* Check to see if loged user is not an admin	*/
	if((Auth::user()->usertype == 'user')){
            // return redirect('/posts')->with('error', 'Unauthorized Page');
        }
	?>
	<?php 
	$lists = $data['lists'];
?>
<style>
	

</style>
<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header" style="background: url('{{url('/public/images/list-header.jpg')}}');">
            <h3>Shopping List</h3>
        </div>

        <ul class="list-unstyled components">
            <p>Welcome to Shopping list, <br>  {{ Auth::user()->name }} </p>
			<li>
                <a href="{{url('dashboard')}}">Home</a>
            </li>
            <li>
                <a href="{{url('lists/create')}}">Add new list</a>
            </li>
            <li class="active">
                <a href="{{url('lists')}}">Your lists</a>
            </li>
        </ul>
    </nav>
	
	<div id="content">
		<div class="row px-3 py-4">
			<div class="col-sm-12 col-md-6 " id="defaultlists">
				<div class="card">
					<div class="card-header">
						My lists
					</div>

					<div class="card-body">
					@if(count($lists) > 0)   
					<table class="table">
						<thead class="thead-dark">
							<tr>
							<th scope="col">#</th>
							<th scope="col">List name</th>
							<th scope="col">View</th>
							<th scope="col">Edit</th>
							<th scope="col">Delete</th>
							</tr>
						</thead>
						<tbody>
						@foreach($lists as $art)
							<tr>
								<th scope="row"><i class="fas fa-circle"></i></th>
								<td>{{$art->listname}}</td>							
								<td>
									<button class="btn btn-success cursor-pointer" onclick="showlist({{$art->listId}})">
										View
									</button> 
								</td>
								<td>
									<button class="btn btn-primary cursor-pointer" onclick="showeditform({{$art->listId}})">
										Edit
									</button> 
								</td>
								<td>
								{!!Form::open(['action' => ['ListsController@destroy', $art->listId], 'method' => 'POST', 'class' => 'pull-right'])!!}
									{{Form::hidden('_method', 'DELETE')}}
									{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
								{!!Form::close()!!}
								</td>
							</tr>
						@endforeach
					  </tbody>
					</table>
					@else
						<p>You do not have any lists</p>
					@endif		
					</div>
				</div>
				
				
				
			</div>
			<div id="showlist" class="col-sm-12 col-md-6" style="display:none">
			</div>
		</div>
	</div> 
	

</div> 

<script>
	$(document).ready(function () {

		$('#sidebarCollapse').on('click', function () {
			$('#sidebar').toggleClass('active');
		});

	});
	
	function showlist(listid){
		$('#showlist').css('display','none');
		var query = listid;
		$.ajax({
			url: '{{url('ajax/getList')}}',
			method:'GET',
			data:{query:query},
			dataType:'json',
			success:function(data){
				$('#showlist').html('');
				$('#showlist').html(data.output); 
				$('#showlist').slideToggle();
			}, error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr.status);
				console.log(thrownError);
			}
		})
		
	}
</script>
@endsection
