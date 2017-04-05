<!DOCTYPE html>
<html>
<head>
<title>Success!</title>
<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
</head>
<body>
	<div class="centered" style="border:none; ">
	<h3>You have successfully Registered.</h3>
	<br>
	<h4>Log In again to continue.</h4>
	<br>
	<?php
		require 'core.php';
		require 'connect.php';
	?>
	<a href="logout.php">Log In</a>
	</div>
</body>
</html>
