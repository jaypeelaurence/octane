@extends('master')

@section ('pageTitle')
	Manage Account
@endsection

@section ('body')
	<div id="content">
		<div id="wrapper">
			<h1 class='title'>List of Accounts</h1>
			<div id="table">
				<table>
					<thead>
						<tr>
							<th class='date'>UID</th>
							<th>Name</th>
							<th>Email Address</th>
							<th>Mobile Number</th>
							<th>Role</th>
							<th>Created At</th>
							<th>Updated At</th>
							<th class='settings'>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($user as $value)
							<tr>
								<td class='date'>{{ $value->id }}</td>
								<td>{{ $value->firstname }} {{ $value->lastname }} </td>
								<td>{{ $value->email }}</td>
								<td>{{ $value->mobile }}</td>
								<td>{{ $value->role }}</td>
								<td>{{ $value->created_at }}</td>
								<td>{{ $value->updated_at }}</td>
								<td class='settings'>
									<form action="{{ url('/') }}/manage-account/{{ $value->id }}" method="POST" id="prompt">
										{{ csrf_field() }}
										<a href="{{ url('/') }}/manage-account/{{ $value->id }}"><i class="fa fa-eye"></i>View</a>
										<a href="{{ url('/') }}/manage-account/{{ $value->id }}/edit"><i class="fa fa-edit"></i>Edit</a>
										<button type="button" id="prompt" value="{{ $value->id }}"><i class="fa fa-trash"></i>Delete</button>
									</form>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

@section ('custom_script')
	<script src="{{ url('/') }}/js/form.js" type="text/javascript"></script>
@endsection