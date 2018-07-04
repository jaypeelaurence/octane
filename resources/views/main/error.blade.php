@extends('dashboard')

@section('pageTitle')
	Page Error
@endsection

@section('body')
	<div id="dashboard">
		<div id="container">
			<h1>Error: {{ $error['code'] }}</h1>
			<h2>{{ $error['message'] }}</h2>
		</div>
	</div>
@endsection