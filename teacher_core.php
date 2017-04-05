<!DOCTYPE html>
<html>
<head>
	<title>Main Menu</title>
	<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
</head>
<body>

<div class="centered" style="width:40%;">
<?php
	require 'core.php';
?>
	<h1>Hello,<?php echo $_SESSION['name'];?>!</h1>	
	<br><a href="profile_teacher.php" style="width:200px;">Profile</a><br>
	<br><a href="create_assignment.php" style="width:200px;">Create An Assignment</a><br>
	<br><a href='assignment_state.php' style="width:200px;">Your assignments</a><br>	
	<br><a href="logout.php">Log Out</a>

</body>
</html>