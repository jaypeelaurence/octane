<!DOCTYPE html>
<html lang="en-US">
	<head>
		@include('_template.head')
	</head>
	<body>
		<div id="header">
			<div id="container">
				@include('_template.header')
			</div>
		</div>
		<div id="body">
			<div id="container">
				@include('_template.alert')

				@include('_template.body')
			</div>
		</div>
		<div id="footer">
			<div id="container">
				@include('_template.footer')
			</div>
		</div>
	</body>
</html>