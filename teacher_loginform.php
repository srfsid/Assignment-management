<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
</head>
<body>
<div class="centered" style="border:none;">
<h1>Assignment Management System</h1>
<?php
	require_once 'core.php';
	require 'connect.php';


	if(isset($_POST['username']) && isset($_POST['password'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		if(!empty($username) && !empty($password)){
			$query = sprintf("SELECT ID,Name FROM teacher 
  		    WHERE Username='%s' AND Password='%s'",
            mysqli_real_escape_string($link,$username),
            mysqli_real_escape_string($link,$password));

			$query_run = mysqli_query($link,$query);

			if($query_run){
				$query_num_rows = mysqli_num_rows($query_run);
				if($query_num_rows==0){
					echo "Invalid username or password. Try again.\n";
				}
				else{
					//$finfo = mysqli_fetch_field($query_run);
					//$currentfield = mysqli_field_tell($query_run);
					
					//$user_id = mysql_result($query_run,0,'ID');
					//$name = mysql_result($query_run,0,'Name');
					$row = mysqli_fetch_row($query_run);

					$_SESSION['user_id']=$row[0];
					$_SESSION['username']=$row[2];
					$_SESSION['name'] = $row[1];
					
					$_SESSION['user_type'] = 1;
					//require 'teacher_core.php';
					//echo nl2br("\n Hello, ".$username."!\n");
					header('Location: teacher_core.php');
				}
			}
			else{
				echo mysqli_error();
			}

		}
		else{
			echo "You must give a username and password.\n";
		}
	}
?>

<form action="" method="POST">
<div class="centered" style="width:350px;">
<br><strong>Log in as teacher</strong><br>

<input type="text" name="username" placeholder="Username">
<br>

<input type="password" name="password" placeholder="Password">
<br>
<button type = "submit" value="Log In" style="width:150px;">Log In</button>
<br>
<a href="teacher_register.php" style="width:150px;">Register</a><br>
</div>
</form>
</div>
</body>
</html>