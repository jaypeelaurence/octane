@if (count($errors))
	<div class='alert alert-danger'>
		<ul>
			@foreach ($errors->all() as $error)
				<li><i class='fa fa-exclamation-circle'></i>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
@if (session()->has('message'))
	<div class='alert alert-success'>
		<ul>
		    <li><i class='fa fa-check-circle'></i>{{ session()->get('message') }}</li>
		</ul>
	</div>
@endif