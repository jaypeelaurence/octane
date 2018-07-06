@if(!isset($transactions))
	<h1 id="message">no transactions found</h1>

	@else
		@if($transaction['type'] == "account")
			<div id="content" class="report">
				<div id="wrapper">
					
				</div>
			</div>
			@elseif($transaction['type'] == "senderId")

			@endelseif
		@endif
	@endelse
@endif