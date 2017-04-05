<?php
	//content type
	header('Content-type: text/plain');
	//open/save dialog box
	header('Content-Disposition: attachment; filename="variables.txt"');
	//read from server and write to buffer
	readfile('variables.txt');
?>