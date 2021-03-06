@extends('master')

@section('pageTitle')
	Account
@endsection

@section('body')
	<div id="content">
		<div id="wrapper">
			<h1 class='title'>{{ $user->firstname }} {{ $user->lastname }}</h1>
			<div id="details">
				<div class="row">
					<div class="col-md-9">
						<table>
							<tr>
								<td>UID</td>
								<td>{{ $user->id }}</td>
							<tr>
							<tr>
								<td>Name</td>
								<td>{{ $user->firstname }} {{ $user->lastname }}</td>
							<tr>
							<tr>
								<td>Email Address</td>
								<td>{{ $user->email }}</td>
							<tr>
							<tr>
								<td>Mobile Number</td>
								<td>{{ $user->mobile }}</td>
							<tr>
							<tr>
								<td>Role</td>
								<td>{{ $user->role }}</td>
							<tr>
							<tr>
								<td>Created at</td>
								<td>{{ $user->created_at }}</td>
							<tr>
							<tr>
								<td>Updated at</td>
								<td>{{ $user->updated_at }}</td>
							<tr>
						</table>
					</div>
					<div class="col-md-3 actions">
						<a href="{{ url('/') }}/account/{{ $user->id }}/change-password" class='edit'><i class="fa fa-edit"></i>Change Password</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection