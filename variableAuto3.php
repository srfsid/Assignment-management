<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
</head>
<body>
<div class="centered">
<h4>Generated variables</h4>
<?php
require 'core.php';
require 'connect.php';

$tset = 1;
$fh = fopen('variables.txt','w');

for(;$tset<=$_SESSION['assign_set'];$tset++){
	$variable = "";
	fwrite($fh,"Set ".$tset.":\n");
	for($tvar=1;$tvar<=$_SESSION['assign_nVariable'];$tvar++){
		$range = rand(1,$_SESSION['assign_variable_bound'.$tvar]);
		//echo $range." ";
		$value = rand($_SESSION['variable_bound'.$tvar.$range.'1'],$_SESSION['variable_bound'.$tvar.$range.'2']);
		
		$variable =$variable."variable".$tvar." = ".$value." ";

		fwrite($fh,$value." ");

	}
	fwrite($fh,"\n\n");
	echo nl2br("Variable for set ".$tset." : ".$variable."\n");
	$_SESSION['assign_variable'.$tset] = $variable;

}
?>
<br>
<a href="download.php">Click to download variable values</a>
<?php
echo nl2br("\n".'<a href="variableAuto3.php">Refresh Values</a>'."\n");


if(isset($_POST['submit'])){
	
	for($tset=1;$tset<=$_SESSION['assign_set'];$tset++){
		$_SESSION['assign_ans'.$tset] = $_POST['ans'.$tset];
	}

	header('Location: assignment_success_auto.php');
}

if(isset($_POST['ans'])){

	header('Location: UploadAns.php');
}


?>
<h4>Input answer from file</h4>
<form action = "UploadAns.php" method = "POST" enctype = "multipart/form-data">
         <input type = "file" name = "ans" class="inButton"/>
         <button type = "submit">Submit</button>
</form>
      
<h4>Or, input answer manually</h4>
<form action="variableAuto3.php" method="POST">
<div class="centered" style="border:none;">
	<?php
	for($tset=1;$tset<=$_SESSION['assign_set'];$tset++){
	?>
		<strong>Ans of set <?php echo $tset." ";?> </strong><br> <input type="varchar" name ="<?php echo'ans'.$tset ?>" size = "50"
		required><br><br>
	<?php

	}

	?>

	<button type="submit" name="submit" value="Submit">Submit</button> 

</form>
</div>
</div>
</body>
</html>