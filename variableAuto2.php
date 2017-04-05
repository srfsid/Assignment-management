<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
</head>
<body>
<div class="centered">
<?php
require 'core.php';
require 'connect.php';
//include_once 'create_assignment.php';


if(isset($_POST['submit'])){
	for($tset=1;$tset<=$_SESSION['assign_nVariable'];$tset++){
		for($tran=1;$tran<=$_SESSION['assign_variable_bound'.$tset];$tran++){

			$_SESSION['variable_bound'.$tset.$tran.'1'] = $_POST['variable'.$tset.$tran.'1'];
			$_SESSION['variable_bound'.$tset.$tran.'2'] = $_POST['variable'.$tset.$tran.'2'];

			//echo $_SESSION['assign_variable_bound'.$tset];
		}
		//$_SESSION['assign_ans'.$tset] = $_POST['ans'.$tset];
	}

	header('Location: variableAuto3.php');
}
?>

<form action="variableAuto2.php" method="POST">
<?php
for($tset=1;$tset<=$_SESSION['assign_nVariable'];$tset++){
	echo nl2br("<strong>Ranges for variable ".$tset."</strong>\n\n");
	for($tran=1;$tran<=$_SESSION['assign_variable_bound'.$tset];$tran++){
?>
	<strong>Start</strong><input type="int" name ="<?php echo'variable'.$tset.$tran.'1' ?>" size = "20"required>
	<strong>End</strong><input type="int" name ="<?php echo'variable'.$tset.$tran.'2' ?>" size = "20"
	required><br> 

<?php

	}
	echo nl2br("\n\n");
}

?>

<button type="submit" name="submit" value="Submit"> Submit</button>

</form>
</div>
</body>
</html>