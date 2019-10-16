@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
		<h4 class="py-2">Add new article</h4>
			{!! Form::open(['action' => 'ArticlesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
			 {{ csrf_field() }}
			
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-shopping-basket"></i></span>
				</div>
				{{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Article name'])}}
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
	<div>
</div>
@endsection
	