@extends('master')

@section('pageTitle')
	Dashboard
@endsection

@section('body')
	<div id="dashboard">
		<div id="container">
			<h1>Welcome,</h1>
			<h2><?= $user[0]->name; ?>!</h2>
			<h3>Today is <?= date('l, F d, Y');?></h3>
		</div>
	</div>
@endsection