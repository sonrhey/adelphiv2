<!DOCTYPE html>
<html>
<head>
	<title>ERROR</title>
	
</head>
<body style="background-color: #ecf0f1">
	
		<div style="text-align: center;">
			<p style="color: #404040; font-size: 80px;">{{ $exception->getMessage() }}</p>
		</div>
		<div style="text-align: center;">
			<h2 style="color: #404040"><span class="fa fa-warning fa-4x"></span></h2>
			<p><i>Please contact the Webmaster, for more information.</i></p>
		</div>
		<div style="text-align: center;">
			<a href="{{  route('out') }}">Back to login page.</a>
		</div>
	
	
</body>
</html>