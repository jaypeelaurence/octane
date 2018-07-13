@if(!isset($transactions))
	<h1 id="message">Generating Transacations</h1>

	@else
		@if(count($transactions['data']) != 0)
				<div id="content" class="report">
					<div id="wrapper">
						<h1 class='title'>
							Account Name: {{ $transactions['accountName'] }}
							@php 
								if(isset($transactions['senderName'])){
									echo "| Sender Name: " . $transactions['senderName'];
								}
							@endphp

							(
								@php 
									$i = 0;
									foreach($transactions['dateRange'] as $date){
										echo $date;
										if($i == 0){
											echo " - ";

											++$i;
										}
									}
								@endphp
							)
						</h1>
						<div id="table">
							<table>
								<thead>
									<tr>
										@foreach ($transactions['column'] as $value)
											@if($value == "date")
												<th class='date'>Date</th>
												@else
													<th>{{ $value }}</th>
											@endif
											@php 
												$column[] = $value;
											@endphp
										@endforeach
									</tr>
								</thead>
								<tbody>
									@foreach ($transactions['data'] as $field)
										<tr>
											@foreach ($column as $data)
												@if($data == "date")
													<td class='date'>{{ $field->{$data} }}</td>
													@else
														<td>{{ $field->{$data} }}</td>
												@endif
											@endforeach
										</tr>
									@endforeach
								</tbody>
							</table>
							<form action="report/download" method="POST">
								{{ csrf_field() }}
								<input type='hidden' name="transactions" value="@php echo base64_encode(json_encode($transactions)); @endphp"/>
								<button type="submit"><i class='fa fa-cloud-download-alt'></i>Download Report</button>
							</form>
						</div>
					</div>
				</div>
			@else
				<h1 id="message">0 Transacations Found</h1>
		@endif

@endif