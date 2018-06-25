<!DOCTYPE html>
<html lang="en-US">
	<head>
		@include('_template.head')
	</head>
	<body>
		<div id=login>
			<div id="container">
				<img src="/images/whitelogo.png">
			</div>
			<div id="container">
				<div id=form>
					<form>
					  <div class="form-group">
					    <label for="username">Username</label>
					    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Password</label>
					    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
					  </div>
					  <button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
			<div id="container">
				@include('_template.footer')
			</div>
		</div>
	</body>
</html>