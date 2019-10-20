@if(count($errors) > 0)
    @foreach($errors->all() as $error)
		<input type="hidden" id="errormessage" name="errormessage" value="Error" />
		<script>toastr.error('{{$error}}','Error')</script>
    @endforeach
@endif

@if(session('success'))
	<script>toastr.success('{{session('success')}}','Success')</script>
@endif

@if(session('error'))
	<input type="hidden" class="errormessage" id="errormessage" name="errormessage" value="Error" />
	<script>toastr.error('{{session('error')}}','Error')</script>
@endif
