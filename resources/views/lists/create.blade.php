@extends('layouts.app')

@section('content')
	<?php
	/* Check to see if loged user is not an admin	*/
	if((Auth::user()->usertype == 'user')){
            // return redirect('/posts')->with('error', 'Unauthorized Page');
    }
	?>
	<?php 
		$categories = $data['categories'];
	?>
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
            <li class="active">
                <a href="{{url('lists/create')}}">Add new list</a>
            </li>
            <li>
                <a href="{{url('lists')}}">Your lists</a>
            </li>
        </ul>
    </nav>
	
	<div id="content">
		<div class="row px-3 py-4">
			<div class="col-sm-12 col-md-8 offset-md-2">
			<h4 class="py-2">Create a new list</h4>
				{!! Form::open(['action' => 'ListsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
				 {{ csrf_field() }}
				
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-shopping-basket"></i></span>
					</div>
					{{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'List name'])}}
				</div>
				<p>Start adding articles to your list. Choose article category and then choose article to add to your list.</p>
				<div class="row">
					<div class="col-sm-12 col-md-6" style="padding-left:0">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-th-large"></i></span>
							</div>
							<select name="category" id="categorieslist" class="form-control form-control-md" onchange="showcategoriearticles()">
								<option value="">Select category</option>
								@foreach($categories as $cat)
									<option value="{{$cat->categoryId}}">{{$cat->categoryname}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-12 col-md-6" id="articles">
						
					</div>
				</div>
				
				<input type="hidden" id="articlelist" name="articlelist" />
				<div style="text-align:center">
					{{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
				</div>
				{!! Form::close() !!}
				
				
			</div>
			<div id="added-items" class="col-sm-12 col-md-8 offset-md-2">
			</div>
		<div>
    </div>
	</div>
</div> 

<script>
	$(document).ready(function () {

		$('.navbar-toggler').addClass('navbar-help');
		$('#activate-sidebar').addClass('sidebar-help');

	});

	function showcategoriearticles(){
		var selectcat = $('#categorieslist').find("option:selected");
		var query = selectcat.val();
		if(query != '' || query != null){
			var form_data = new FormData(); 
			form_data.append('getarticlesajax', true);
			form_data.append('category', query);
			$.ajax({
				url: '{{url('ajax/getArticles')}}',
				method:'GET',
				data:{query:query},
				dataType:'json',
				success:function(data){
					$('#articles').html('');
					$('#articles').html(data.table_data);
				}, error: function (xhr, ajaxOptions, thrownError) {
					console.log(xhr.status);
					console.log(thrownError);
				}
			})
		}	
	}
	$(document).on('change', '.artikli', function() {
		if(this.checked) {
			var artikl = this.value;
			
			var added = $('#articlelist').val();
			added = added + artikl + ';';
			
			$('#articlelist').val(added);
			var vrijednost = $('#articlelist').val();

			var id = this.id;
			var checkbox = $('#div'+id).clone();
			$('#added-items').append(checkbox);
			$('#div'+id+' '+id).addClass("dodani");
			$('#div'+id+' '+id).removeClass("artikli");
		}
	});

	
</script>
@endsection
