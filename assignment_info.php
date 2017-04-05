<?php
require 'core.php';
require 'connect.php';

$ID = $_SESSION['submit_ID'];
$_SESSION['delete_id'] = $ID;
$query = sprintf("SELECT a.Name,t.Name,a.Topic,a.Problem,a.Resource_Link,a.Starting_Time,a.Ending_Time,e.Set_ID,a.Variable,e.Student_Ans
					FROM assignment as a
					JOIN teacher as t ON a.Teacher_ID = t.ID
					JOIN enroll as e ON a.Assignment_ID = e.Assignment_ID
					WHERE e.Set_ID = a.Set_ID AND e.Student_ID = '%d' AND e.Assignment_ID = '%d';",
			mysqli_real_escape_string($link,$_SESSION['user_id']),
			mysqli_real_escape_string($link,$ID));
$query_run = mysqli_query($link,$query);
$query_num_rows = mysqli_num_rows($query_run);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Assignment Information</title>
		<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
		<script type="text/javascript" src="date_time.js"></script>
	</head>
	<body>
	<div style="display:flex; justify-content:space-between;">
		<a href="student_core.php">Home</a>
		<span id="date_time"></span>
		<script type="text/javascript">window.onload = date_time('date_time');</script>
	</div>

	<?php
		if(!$query || $query_num_rows==0){
	?>
		<h1>Error! No Information Retrieved!</h1>
	<?php
		}
		else{
			$row = mysqli_fetch_row($query_run);
	?>
		<table>
			<thead>
				<tr>
					<th colspan="2">Assignment Information</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><strong>Title: </strong><?php echo $row[0] ?></td>
					<td><strong>ID: </strong><?php echo $ID ?></td>
				</tr>
				<tr>
					<td><strong>Problem setter: </strong><?php echo $row[1]; ?></td>
					<td><strong>Topic: </strong><?php echo $row[2] ?></td>
				</tr>
				<tr>
					<td colspan="2"><strong>Problem: </strong><?php echo $row[3]?></td>
				</tr>
				<tr>
					<td colspan="2"><strong>Resource/Links: </strong><?php echo $row[4]?></td>
				</tr>
				<tr>
					<td><strong>Starting Time:</strong> <?php echo $row[5]?></td>
					<td><strong>Ending Time: </strong><?php echo $row[6]?></td>
				</tr>
				<tr>
					<td colspan="2"><strong>Set ID:</strong> <?php echo $row[7]?></td>
				</tr>
				<tr>
					<td><strong>Variable: </strong><?php echo $row[8]?></td>
					<td><strong>Your Answer: </strong><?php if($row[9] == '') echo 'Not answered yet'; else echo $row[9]?></td>
				</tr>
				<tr>
					<td colspan="2"><a href='submit_answer.php'>Submit Your Answer</a></td>
				</tr>
			</tbody>
		</table>
	<?php
		}
	?>
	
	</body>
</html>
