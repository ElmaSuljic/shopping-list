@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
	<div>
</div>
@endsection
	