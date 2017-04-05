<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
</head>
<body>
<div class="centered" style="width:40%;">
<?php
	require 'core.php';
?>
	<h1>Hello, <?php echo $_SESSION['name']?>!</h1>
	<a href="profile_student.php" style="width:200px;">Profile</a><br>
	<a href='student_enroll.php' style="width:200px;">Enroll to an assignment</a><br>
	<a href='assignment_details.php'style="width:200px;">Your assignments</a><br>
	<a href="logout.php">Log Out</a><br><br>

</div>

</body>
</html>