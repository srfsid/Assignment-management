<?php
require 'core.php';
require 'connect.php';

$query = sprintf("SELECT * FROM teacher WHERE ID = '%d';",mysqli_real_escape_string($link,$_SESSION['user_id']));
$query_run = mysqli_query($link,$query);

$_SESSION['pro_pic'] = "uploads/default_profile.png";

$pquery = sprintf("SELECT Link FROM images WHERE UserType = '1' AND ID = '%d';",mysqli_real_escape_string($link,$_SESSION['user_id']));
$pquery_run = mysqli_query($link,$pquery);
$pquery_num_rows = mysqli_num_rows($pquery_run);
if($pquery_num_rows>0){
	$pic = mysqli_fetch_row($pquery_run);
	$_SESSION['pro_pic'] = $pic[0];
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
</head>
<body>
	<a href="teacher_core.php">Home</a>
	<div class="centered" style="border:none;">
	<img src="<?php echo $_SESSION['pro_pic'] ?>" height="200" width="200">
	<form action="uploadUserImage.php" method="post" enctype="multipart/form-data">
    			<input type="file" name="fileToUpload" id="fileToUpload" class="inButton">
    			<button type="submit" value="Upload Image" name="submit"">Upload</button>
	</form>
	</div>
<?php
if(!$query_run){
?>
	<h2>Error! Please try again later.</h2>
<?php
}
else{
$result = mysqli_fetch_row($query_run);
?>
	<table>
		<tbody>
			<tr>
				<td><strong>Name </strong></td><td><?php echo $result[1];?></td>
			</tr>
			<tr>
				<td><strong>Username </strong></td><td><?php echo $result[2];?></td>
			</tr>
			<tr>
				<td><strong>Email </strong></td><td><?php echo $result[4];?></td>
			</tr>
			<tr>
				<td><strong>Department </strong></td><td><?php echo $result[5];?></td>
			</tr>
			<tr>
				<td></td>
				<td><a href="chng_pass_t.php">Change Password</a></td>
			</tr>
		</tbody>
	</table>
<?php	
}
?>
</body>
</html>