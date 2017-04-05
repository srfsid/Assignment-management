
<!DOCTYPE html>
<html>
<head>
	<title>Create New Account</title>
	<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
</head>
<body>
<?php
require_once 'core.php';
require 'connect.php';
if(!loggedin()){

	if(isset($_POST['name'])&&
	   isset($_POST['username'])&&
	   isset($_POST['reg'])&&
	   isset($_POST['email'])&&
	   isset($_POST['password'])&&
	   isset($_POST['confirm_password'])&&
	   isset($_POST['department'])){

		$name = $_POST['name'];
	    $username = $_POST['username'];
	    $reg = $_POST['reg'];
	    $email = $_POST['email'];
	    $password = $_POST['password'];
	    $confirm_password = $_POST['confirm_password'];
	    $department = $_POST['department'];
	    if(!empty($name) && !empty($username) && !empty($reg) && !empty($email) && !empty($password) && !empty($confirm_password) && !empty($department) ){
		    if($password!=$confirm_password){
		    	echo "Password's do not match.\n";
		    }
		    else{
		    	$query = sprintf("SELECT Username FROM student 
	  		    WHERE Username='%s'",
	            mysqli_real_escape_string($link,$username));

				$query_run = mysqli_query($link,$query);

				if(mysqli_num_rows($query_run)==1){
					echo "The username already exists.\n";
				}
				else{
					$query = sprintf("INSERT INTO student VALUES('','%s','%s','%s','%s','%s','%s')",
						mysqli_real_escape_string($link,$name),
						mysqli_real_escape_string($link,$username),
						mysqli_real_escape_string($link,$reg),
						mysqli_real_escape_string($link,$password),
						mysqli_real_escape_string($link,$email),
						mysqli_real_escape_string($link,$department));

					$query_run = mysqli_query($link,$query);


					if($query_run){
						header('Location: register_success.php');
					}
					else{
						echo "Sorry, Registration unsuccessfull. Try again later.";
					}
				}
		    }
		}
	}


?>


<form action="student_register.php" method="POST">
<div class="register" style="border:none;">
<h3>Enter your details</h3>
<br> <input type="text" name ="name" placeholder="Name" required><br>
<br> <input type="text" name ="username" placeholder="Username" required><br>
<br> <input type="text" name="reg" placeholder="Registration No." required><br>
<br> <input type="text" name ="department" placeholder="Department" required><br>
<br> <input type="text" name="email" placeholder="Email" required><br>
<br> <input type="password" name ="password" placeholder="Password" required><br>
<br> <input type="password" name ="confirm_password" placeholder="Confirm Password" required><br><br>


<button type="submit" value="Register" style="width:200px;">Create Account</button>
</form>
</div>

<?php
}
else if(loggedin()){
	echo "You are already registered and logged in.\n";
}

?>
</body>
</html>