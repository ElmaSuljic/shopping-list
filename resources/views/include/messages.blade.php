@if(count($errors) > 0)
    @foreach($errors->all() as $error)
		<script>toastr.error('{{$error}}','Error')</script>
    @endforeach
@endif

@if(session('success'))
	<script>toastr.success('{{session('success')}}','Success')</script>
@endif

@if(session('error'))
	<script>toastr.error('{{session('error')}}','Error')</script>
@endif
