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
										@php 
											$a = 0;
											foreach($transactions['column'] as $value){
												if($a == 0){
													echo "<th class='date'>$value</th>";
												}else{
													echo "<th>$value</th>";
												}
												++$a;
												$column[] = $value;
											}
										@endphp
									</tr>
								</thead>
								<tbody>
									@php
										foreach ($transactions['data'] as $field){
											echo "<tr>";
											$b = 0;
											foreach ($column as $data){
												if($b == 0){
													echo "<td class='date'>" . $field->{$data} . "</td>";
												}else{
													echo "<td>" . $field->{$data} . "</td>";
												}
												++$b;
											}
											echo "</tr>";
										}
									@endphp
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