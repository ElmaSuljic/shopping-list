@extends('layouts.app')

@section('content')
	<?php 
		$art = $data['article']; 
		$categories = $data['categories']; 
	?>
	<div class="container py-5">
		<div class="row justify-content-center">
			<div class="col-md-12">
			<h1 class="py-2">Edit Article</h1>
			{!! Form::open(['action' => ['ArticlesController@update', $art->articleId], 'method' => 'POST']) !!}
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-shopping-basket"></i></span>
					</div>
					{{Form::text('name', $art->articlename, ['class' => 'form-control', 'placeholder' => 'Article name name'])}}
				</div>
					
				<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-th-large"></i></span>
				</div>
				<select name="category" class="form-control form-control-md">
			        @foreach($categories as $cat)
						<option value="{{$cat->categoryId}}" @if ($cat->categoryId == $art->categoryId) selected @endif >{{$cat->categoryname}}</option>
					@endforeach
				</select>
			</div>
				{{Form::hidden('_method','PUT')}}
				<div style="text-align:center">
					{{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
				</div>
			{!! Form::close() !!}
			</div>
		<div>
	</div>
@endsection