@if(!isset($transactions))
	<h1 id="message">Generating Transacations</h1>

	@else
		@if($transactions['type'] == "account")
			<div id="content" class="report">
				<div id="wrapper">
					<div id="table">
						<table>
							<thead>
								<tr>
									<th class='date'>DATE</th>
									<th>TOTAL</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($transactions['data'] as $value)
									<tr>
										<td class='date'>{{ $value->date }}</td>
										<td>{{ $value->total }} </td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			@elseif($transactions['type'] == "senderId")
		@endif
@endif