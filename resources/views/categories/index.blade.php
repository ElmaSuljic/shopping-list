@extends('layouts.app')

@section('content')
<div class="py-5">
	<?php $categories = $data['categories']; ?>
	<?php
	if(isset($helperror)){
		echo 'ddd';
		echo '<script>showcreateform();</script>';
	}
	?>
	
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
					Categories
					<span class="btn btn-primary cursor-pointer" style="float:right;" onclick="showcreateform()">
						Add new category
					</span>
				</div>

                <div class="card-body">
                @if(count($categories) > 0)   
				<table class="table">
					<thead class="thead-dark">
						<tr>
						<th scope="col">#</th>
						<th scope="col">Categorie</th>
						<th scope="col">Edit</th>
						<th scope="col">Delete</th>
						</tr>
					</thead>
					<tbody>
					@foreach($categories as $cat)
						<tr>
							<th scope="row">1</th>
							<td>{{$cat->categoryname}}</td>
							<td>
								<button class="btn btn-primary cursor-pointer">
									<a style="color:#fff" href="categories/{{$cat->categoryId}}/edit">Edit</a> 
								</button>
							</td>
							<td>
							{!!Form::open(['action' => ['CategoriesController@destroy', $cat->categoryId], 'method' => 'POST', 'class' => 'pull-right'])!!}
								{{Form::hidden('_method', 'DELETE')}}
								{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
							{!!Form::close()!!}
							</td>
						</tr>
					@endforeach
				  </tbody>
				</table>
				@else
					<p>No categories added</p>
					<button class="btn btn-primary">
						<a style="color:#fff" href="categories/create">Add categorie</a>
					</button>
				@endif		
                </div>
            </div>
        </div>
		<div class="col-md-6" id="createform" style="display:none">
			<h4>Add new category</h4>
			{!! Form::open(['action' => 'CategoriesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
			 {{ csrf_field() }}
			
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-th-large"></i></span>
				</div>
				{{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Categorie name'])}}
			</div>
			
			{{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
			{!! Form::close() !!}
		</div>
		
		<div class="col-md-6" id="editform" style="display:none">
			<h4>Add new category</h4>
			<div id="inserteditform"></div>
		</div>
	</div>
	
</div>
	<script>
	function showcreateform(){
		$('html,body').animate({
			scrollTop: 0
		}, 500);

		$('#createform').slideToggle();
	}
	
	function showeditform(id){
		$('#editform').css('display','block');
		$('#createform').css('display','none');
		$.ajax({
			url: 'categories/'+id+'/edit',
			type: 'get',
			dataType: 'json',
			contentType: 'application/json; charset=utf-8',
			success:function(data){
				console.log(data);
				$('#inserteditform').empty();
				$('#inserteditform').html(data.editform);
			}, error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr.status);
				console.log(thrownError);
			  }
		  })

	}
	</script>

@endsection
