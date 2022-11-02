<?php
	$host = ""; // Host name 
	$db_username = ""; // Mysql username 
	$db_password = ""; // Mysql password 
	$db_name = ""; // Database name 

	$mysqli_conection = mysqli_connect($host, $db_username, $db_password, $db_name)or die("cannot connect"); 
?>