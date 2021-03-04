<!DOCTYPE html>
<html>
<head>
	<title>ERROR</title>
	
</head>
<body style="background-color: #ecf0f1">

	<div class="container">
		<div style="text-align: center;">
			<p style="color: #404040; font-size: 180px;">402</p>
		</div>
		<div style="text-align: center;">
			<h2 style="color: #404040">{{ $exception->getMessage() }}</h2>
			<p>You don't have the permission to access this page.</p>
		</div>
		<div style="text-align: center;">
			<a href="/verify" class="btn btn-danger">BACK</a>
		</div>

	</div>
	
</body>
</html>