<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
</head>
<body>
<div style="display:flex; justify-content:center;">
<h1>Assignment Management System</h1>
</div>
<div class="center" style="width:300px;">
<?php
require_once 'core.php';
require 'connect.php';

if(loggedin()){
?>
	You are logged in. <a href="logout.php">Log Out</a>
<?php
}
else{
?>	
	<div style="display:flex; justify-content:center; align-items:center; flex-direction:column">
	<strong>Login as</strong>
	<a href="teacher_loginform.php" style="width:150px;">Teacher</a>
	<br>
	<a href="student_loginform.php" style="width:150px;">Student</a>
	</div>
<?php
	}
?>
</div>
</body>
</html>