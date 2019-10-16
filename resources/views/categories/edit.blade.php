@extends('layouts.app')

@section('content')
	<?php $cat = $categorie[0]; ?>
	<div class="container py-5">
		<div class="row justify-content-center">
			<div class="col-md-12">
			<h1>Edit Category</h1>
			{!! Form::open(['action' => ['CategoriesController@update', $cat->categoryId], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-th-large"></i></span>
					</div>
					{{Form::text('name', $cat->categoryname, ['class' => 'form-control', 'placeholder' => 'Categorie name'])}}
				</div>
				{{Form::hidden('_method','PUT')}}
				{{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
			{!! Form::close() !!}
			</div>
		<div>
	</div>
@endsection