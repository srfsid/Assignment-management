
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
	<script type="text/javascript" src="date_time.js"></script>
</head>
<body>

<div style="display:flex; justify-content:space-between;">
		<a href="student_core.php">Home</a>
		<span id="date_time"></span>
		<script type="text/javascript">window.onload = date_time('date_time');</script>
</div>

<div class="centered" style="width:20%;">
<?php
require 'core.php';
require 'connect.php';

if(isset($_POST['ans']) && !empty($_POST['ans'])){


	date_default_timezone_set('Asia/Dhaka');
	$datetime = date('m/d/Y h:i:s a', time());
	
	$tquery = sprintf("SELECT DISTINCT Starting_Time, Ending_Time FROM Assignment
					WHERE Assignment_ID = '%d'",
					mysqli_real_escape_string($link,$_SESSION['submit_ID']));
	
	$tquery_run = mysqli_query($link,$tquery);
	$res = mysqli_fetch_row($tquery_run);
	
	$start = $res[0];
	$end = $res[1];
	
	
	$sT = DateTime::createFromFormat('Y/m/d H:i', $start);
	$eT = DateTime::createFromFormat('Y/m/d H:i', $end);
	
	$startTime = $sT->getTimestamp();
	$endTime = $eT->getTimestamp();
	$currentTime = time();
	
	if($currentTime >= $startTime && $currentTime <= $endTime){
		
		$query = sprintf("UPDATE enroll SET Student_Ans = '%s', Submission_Time = '%s'
					  WHERE Assignment_ID='%d' AND Student_ID='%d'",
					    mysqli_real_escape_string($link,$_POST['ans']),
					    mysqli_real_escape_string($link,$datetime),
					    mysqli_real_escape_string($link,$_SESSION['submit_ID']),
					    mysqli_real_escape_string($link,$_SESSION['user_id']));

					$query_run = mysqli_query($link,$query);


					if($query_run){
						echo nl2br("Your answer was submitted successfully!\n\n");
						echo nl2br("Your Submission Time : ".$datetime."\n\n");
					}
					else{
						echo mysqli_error($link);
						echo nl2br("Sorry, Submission unsuccessfull. Try again later.\n");
					}
		
	}
	else{
		echo nl2br("<strong>You cannot submit answer for this problem now. See assignment details for starting and ending time.</strong>\n");
	}

}



?>


<form action="submit_answer.php" method="POST">
<div class="centered" style="border:none;"
<br> <input type="text" name ="ans" size = "25" placeholder="Your Answer" required><br><br>
<button type="submit" value="submit" style="width:200px;">Submit</button><br>
<a href="assignment_details.php" style="width:150px;">View assignments</a><br>
<a href="student_core.php" style="width:150px;">Home</a>
</div>
</form>
</div>
</body>
</html>