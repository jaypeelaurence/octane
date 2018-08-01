@if(!isset($transactions))
	<h1 id="message">Generating Transactions</h1>
	@else
		@if(count($transactions['data']) != 0)
			@else
				<h1 id="message">0 Transactions Found</h1>
		@endif
@endif