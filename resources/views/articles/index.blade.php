@extends('layouts.app')

@section('content')
<div class="py-5">
<?php 
	$articles = $data['articles'];
	$categories = $data['categories']; 
?>
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
                @if(count($articles) > 0)   
				<table class="table">
					<thead class="thead-dark">
						<tr>
						<th scope="col">#</th>
						<th scope="col">Article</th>
						<th scope="col">Categorie</th>
						<th scope="col">Edit</th>
						<th scope="col">Delete</th>
						</tr>
					</thead>
					<tbody>
					@foreach($articles as $art)
						<tr>
							<th scope="row">1</th>
							<td>{{$art->articlename}}</td>
							<td>{{$art->category->categoryname}}</td>
							<td>
								<button class="btn btn-primary cursor-pointer">
									<a style="color:#fff" href="articles/{{$art->articleId}}/edit">Edit</a> 
								</button>
							</td>
							<td>
							{!!Form::open(['action' => ['ArticlesController@destroy', $art->articleId], 'method' => 'POST', 'class' => 'pull-right'])!!}
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
						<a style="color:#fff" href="artilces/create">Add article</a>
					</button>
				@endif		
                </div>
            </div>
        </div>
		<div class="col-md-6" id="createform" style="display:none">
			
			<h4 class="py-2">Add new article</h4>
			{!! Form::open(['action' => 'ArticlesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
			 {{ csrf_field() }}
			
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-shopping-basket"></i></span>
				</div>
				{{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Article name name'])}}
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-th-large"></i></span>
				</div>
				<select name="category" class="form-control form-control-md">
			        @foreach($categories as $cat)
						<option value="{{$cat->categoryId}}">{{$cat->categoryname}}</option>
					@endforeach
				</select>
			</div>
			<div style="text-align:center">
				{{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
			</div>
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
	

	</script>

@endsection
