@if(!isset($transactions))
	<h1 id="message">Generating Transactions</h1>
	@else
		<div id="content" class="report">
			<div id="wrapper">
				<h1 class='title'>
					@php 
						if($transactions['type'] != 'auditReport'){
							echo "Account | ";

							foreach($transactions['accountName'] as $accountName){
								echo $accountName . " ";
							}

							echo isset($transactions['senderName']) ? " | " . $transactions['senderName'] . " | ": " | ";
						}else{
							echo "Audit Log |  ";

							if($transactions['accountName']){
								echo $transactions['accountName'] . " | ";
							}
						}

						echo "Date Range: ";

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
								
								@php 
									echo "<th class='date'>";
										if($transactions['type'] == 'auditReport'){ echo $transactions['column'][0];}
									echo "</th>";

									foreach($transactions['column'] as $key => $value){
										if($key == 0 && $transactions['type'] != 'auditReport'){
											echo "<th>$value</th>";
										}elseif($transactions['type'] == 'auditReport' && $value == "ID"){
										}else{
											echo "<th>$value</th>";
										}
										$column[] = $value;
									}

									if($transactions['type'] != "auditReport"){
										if($transactions['type'] != "account"){
											echo "<th>Total</th>";
										}
									}
								@endphp
							</tr>
						</thead>
						<tbody>
                            @php
                            	if($transactions['type'] != "auditReport"){
	                                if($transactions['type'] != "account"){
	                                        foreach ($transactions['data']['count'] as $row => $data){
	                                            echo "<tr>";

	                                            echo "<td class='date'>$row</td>";

	                                            foreach($column as $col){
	                                                    echo "<td>" . $data[$col] . "</td>";
	                                            }

	                                            echo "<td class='date'>" . $transactions['data']['total']['col'][$row] . "</td>";

	                                            echo "</tr>";
	                                        }
	                                }

	                                echo "<tr>";
                                        echo "<td class='date'>Total</td>";

                                        foreach ($transactions['data']['total']['row'] as $row => $data){
                                            echo "<td class='date'>$data</td>";
                                        }
	                                echo "</tr>";
                                }else{
                                    foreach ($transactions['data'] as $data){
		                                echo "<tr>";
	                                        echo "<td class='date'>" . $data->id . "</td>";
	                                        echo "<td>" . $data->user . "</td>";
	                                        echo "<td>" . $data->activity . "</td>";
	                                        echo "<td>" . $data->date_logged . "</td>";
		                                echo "</tr>";
	                            	}
                            	}
                            @endphp

						</tbody>
					</table>

					@php
						if($transactions['type'] != "auditReport"){
					@endphp
					<form action="{{ url('/') }}/report/download" method="POST">
						{{ csrf_field() }}
						<input type='hidden' name="transactions" value="@php echo base64_encode(json_encode($transactions)); @endphp"/>
						<button type="submit"><i class='fa fa-cloud-download-alt'></i>Download Report</button>
					</form>
					@php
						}
					@endphp
				</div>
			</div>
		</div>
@endif