<?php 
require 'core.php';
require 'connect.php';

$ID = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
</head>
<body>
<a href="teacher_core.php">Home</a>
<a href="profile_teacher.php">Back to profile</a>
<div class="centered" style="border:none; font-weight:bold;">
<?php 
if(isset($_POST['new_pass'])){
	$new = $_POST['new_pass'];
	$confirm = $_POST['confirm_pass'];
	if($new == $confirm){
		$query = sprintf("UPDATE student SET Password = '%d' WHERE ID = '%d';",
					mysqli_real_escape_string($link,$new),
					mysqli_real_escape_string($link,$ID));
					
		$query_run = mysqli_query($link,$query);
		if(!$query_run){
			echo "<p>Error! Password has not changed. Please try again</p>";
		}
		else{
			echo "<p>Password changed successfully.</p>";
		}
	}
	else {
		echo "<p>Entered password has not matched.</p>";
		echo "<p>Password unchanged.</p>";
	}
}
?>

	<form action="" method="post">
	<div class="centered">
	<input type="password" name="new_pass" placeholder="New Password" required><br>
	<input type="password" name="confirm_pass" placeholder="Confirm Password" required><br>
	<button type="submit">Proceed</button>
	</div>
	</div>
</body>
</html>