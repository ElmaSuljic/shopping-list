@extends('layouts.app')

@section('content')
	<?php
	/* Check to see if loged user is not an admin	*/
	if((Auth::user()->usertype == 'user')){
            // return redirect('/posts')->with('error', 'Unauthorized Page');
    }
	?>
	<?php 
		$list = $data['list'];
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
			<div class="col-sm-12 col-md-8 offset-md-2">
			<h4 class="py-2">Edit list</h4>
				{!! Form::open(['action' => ['ListsController@update', $list->listId], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
				 {{ csrf_field() }}
				
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-shopping-basket"></i></span>
					</div>
					{{Form::text('name', $list->listname, ['class' => 'form-control', 'placeholder' => 'List name'])}}
				</div>
				<div class="card">
					<div class="card-header">
						<h4 style="text-align:center;text-transform:uppercase">Added items</h4>
						<small>Items with checkmark are the ones you already crossed of list and are not visible in your list.
						To add them again, uncheck the button and save. To remove them permanently from list, 
						just click on red button next to them.</small>
					</div>
					<div class="card-body">
						<div class="col-sm-12" id="added-items">
							<?php $articles = ''; ?>
							@if(count($list->articles) > 0)
								@foreach ($list->articles as $la)
									<?php $articles .= $la->article->articleId.';'; ?>
									<div class="form-check custom-control-inline" id="divcheck{{$la->id}}">
										<input type="checkbox" class="form-check-input listarticles" 
										value="{{$la->articleId}}" id="check{{$la->id}}" name="articles{{$la->articleId}}"
										<?php if($la->checked == 1){ echo 'checked';}?>
										>
										<label class="form-check-label" for="exampleCheck{{$la->id}}">{{$la->article->articlename}}</label>
										<span onclick="removefromlist({{$la->id}})" style="padding-left:15px; cursor:pointer;color:red">
											<i class="fas fa-minus"></i>
										</span>
									</div>
								@endforeach
							@endif
						</div>
					</div>
				</div>
				<p class="py-3" >Need more items to your list? Start adding them down below.</p>
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
				
				<input type="hidden" id="articlelist" name="articlelist" value="{{$articles}}"/>
				<div style="text-align:center">
					{{Form::hidden('_method','PUT')}}
					{{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
				</div>
				{!! Form::close() !!}
				
				
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
		var listid = '{{$list->listId}}';
		var selectcat = $('#categorieslist').find("option:selected");
		var query = selectcat.val();
		if(query != '' || query != null){
			$.ajax({
				url: '{{url('ajax/getArticlesNotInList')}}',
				method:'GET',
				data:{category:query, listid:listid},
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
	
	/* Remove saved list item */
	function removefromlist(itemid){
		var listid = '{{$list->listId}}';

		$.ajax({
			url: '{{url('ajax/removeFromList')}}',
			method:'GET',
			data:{listid:listid, itemid:itemid},
			dataType:'json',
			success:function(data){
				if(data.state == 1){
					var added = $('#articlelist').val();
					changed = added.replace(itemid+';','');
					$('#articlelist').val(added);
					$('#divcheck'+itemid).css('display','none');
					
				}else{
					toastr.error(data.message,'Error')
				}
			}, error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr.status);
				console.log(thrownError);
			}
		})	
	}
	
	/* Remove before saving */
	function removefromlistadded(itemid){
		var added = $('#articlelist').val();
		changed = added.replace(itemid+';','');
		$('#articlelist').val(added);
		$('#divcheck'+itemid).css('display','none');
		
	}
	$(document).on('change', '.artikli', function() {
		if(this.checked) {
			var artikl = this.value;
			var articlename = $('#label'+artikl).html();
			var added = $('#articlelist').val();
			added = added + artikl + ';';
			$('#articlelist').val(added);
			var vrijednost = $('#articlelist').val();
			var newcheckbox = '<div class="form-check custom-control-inline" id="divcheck'+artikl+'">';
			newcheckbox +=	'<input type="checkbox" class="form-check-input listarticles"'; 
			newcheckbox +=	'value="'+artikl+'" id="check'+artikl+'" name="articles'+artikl+'" >';
			newcheckbox +=	'<label class="form-check-label" for="exampleCheck'+artikl+'">'+articlename+'</label>';
			newcheckbox +=	'<span onclick="removefromlistadded('+artikl+')" style="padding-left:15px; cursor:pointer;color:red"><i class="fas fa-minus"></i>';
			newcheckbox +=	'</span></div>';
			$('#added-items').append(newcheckbox);
			
			
			
		}
	});

	
</script>
@endsection
