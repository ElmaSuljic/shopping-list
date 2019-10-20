@extends('layouts.app')

@section('content')
<div class="py-5">
	<?php $categories = $data['categories']; ?>

    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="card">
                <div class="card-header">
					Categories
					<span class="btn btn-primary cursor-pointer" style="float:right;" id="activateAdd" onclick="showcreateform()">
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
							<th scope="row"><i class="fas fa-minus"></i></th>
							<td>{{$cat->categoryname}}</td>
							<td>
								<!--
								<button class="btn btn-primary cursor-pointer">
									<a style="color:#fff" href="categories/{{$cat->categoryId}}/edit">Edit</a> 
								</button> 
								-->
								<button class="btn btn-primary cursor-pointer" onclick="showeditform({{$cat->categoryId}})">
									Edit
								</button> 
							</td>
							<td>
							{!!Form::open(['action' => ['CategoriesController@destroy', $cat->categoryId], 'method' => 'POST', 'onclick' => 'return confirm(\'Are you sure you want to delete category?\');' , 'class' => 'pull-right'])!!}
								{{Form::hidden('_method', 'DELETE')}}
								{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
							{!!Form::close()!!}
							</td>
						</tr>
					@endforeach
				  </tbody>
				</table>
				{{ $categories->links() }}
				@else
					<p>No categories added</p>
					<span class="btn btn-primary cursor-pointer" style="float:right;" id="activateAdd" onclick="showcreateform()">
						Add new category
					</span>
				@endif		
                </div>
            </div>
        </div>
		
		<div class="modal" id="myModal" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="col-md-12" id="createform" style="display:none">
							<h4 class="py-2">Add new category</h4>
							{!! Form::open(['action' => 'CategoriesController@store', 'method' => 'POST', 'id' => 'addCategoryForm' ,'enctype' => 'multipart/form-data']) !!}
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
						
						<div class="col-md-12" id="editform" style="display:none">
							<h4 class="py-2">Edit category</h4>
							<div id="inserteditform">
								{!! Form::open(['action' => ['CategoriesController@update', $cat->categoryId], 'id' => 'formeditaction', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-th-large"></i></span>
									</div>
									{{Form::text('name', $cat->categoryname, ['class' => 'form-control', 'id' => 'nameedit','placeholder' => 'Categorie name'])}}
								</div>
								{{Form::hidden('_method','PUT')}}
								{{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
							{!! Form::close() !!}
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
</div>
	<script>
	function showcreateform(){
		$('#createform').css('display','none');
		$('#myModal').modal('show');
		$('html,body').animate({
			scrollTop: 0
		}, 500);

		$('#createform').slideToggle();
		$('#editform').css('display','none');
	}
	
	function showeditform(id){
		$('#editform').css('display','none');
		$('#myModal').modal('show');
		$('#editform').slideToggle();
		$('#createform').css('display','none');
		$.ajax({
			url: 'categories/'+id,
			type: 'get',
			dataType: 'json',
			contentType: 'application/json; charset=utf-8',
			success:function(data){
				$('#nameedit').val(data.name);
				var prevaction = $('#formeditaction').attr('action');
				var res = prevaction.split("/categories");
				var newaction = res[0]+'/categories/'+data.id;
				$('#formeditaction').attr('action', newaction);
			}, error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr.status);
				console.log(thrownError);
			  }
		  })

	}
	</script>

@endsection
