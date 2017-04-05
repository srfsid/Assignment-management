<?php
require 'core.php';
require 'connect.php';
	
	for($var=1;$var<=$_SESSION['assign_set'];$var++){
		echo nl2br($_SESSION['assign_ans'.$var]);
	}

?>