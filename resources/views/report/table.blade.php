@if(!isset($transactions))
	<h1 id="message">Generating Transactions</h1>
	@else
		<div id="content" class="report">
			<div id="wrapper">
				<h1 class='title'>Account:
					@php 
						foreach($transactions['accountName'] as $accountName){
							echo $accountName . " ";
						}
					@endphp
					@php 
						if(isset($transactions['senderName'])){
							echo "| Sender ID: " . explode(' => ', $transactions['senderName'])[1];
						}
					@endphp
					@php 
						echo "| Date Range: ";

						foreach($transactions['dateRange'] as $key => $date){
							echo $date;

							if($key == 0){
								echo ' - ';
							}
						}
					@endphp
				</h1>
				<div id="table">
					<table>
						<thead>
							<tr>
								<th class='date'></th>
								@php 
									foreach($transactions['column'] as $key => $value){
										if($key == 0){
											echo "<th>$value</th>";
										}else{
											echo "<th>$value</th>";
										}
										$column[] = $value;
									}
								@endphp
							</tr>
						</thead>
						<tbody>
							@php
								if($transactions['type'] != "account"){
									foreach ($transactions['data']['row'] as $row => $data){
										echo "<tr>";

											echo "<td class='date'>$row</td>";

											foreach($column as $col){
												echo "<td>" . $data[$col] . "</td>";
											}

										echo "</tr>";
									}
								}

								echo "<tr>";
									echo "<td class='date'>Total</td>";
										foreach ($transactions['data']['total'] as $row => $data){
											echo "<td class='date'>$data</td>";
										}
								echo "</tr>";

							@endphp
						</tbody>
					</table>
					<form action="{{ url('/') }}/report/download" method="POST">
						{{ csrf_field() }}
						<input type='hidden' name="transactions" value="@php echo base64_encode(json_encode($transactions)); @endphp"/>
						<button type="submit"><i class='fa fa-cloud-download-alt'></i>Download Report</button>
					</form>
				</div>
			</div>
		</div>
@endif