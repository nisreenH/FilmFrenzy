<?php
$db_server = 'localhost';
$db_username='root';
$db_password = '';
$db_name = 'filmfrenzy';


$con = mysqli_connect($db_server,$db_username,$db_password,$db_name);

if(!$con){
	echo "Failed to connect to mysql " .mysqli_connect_errno;
	echo "</br> Failed to connect to mysql " .mysqli_connect_error;
	die("Database Connection error");	
}


?>
