<?php

$dbservername= "localhost";
$dbusername= "id14922748_admin";
$dbpassword = "1xScn__pms@M!bP3";
$dbname = "id14922748_dealkart";


$conn= mysqli_connect($dbservername,$dbusername,$dbpassword,$dbname);
if(!$conn){
	die("Connection failed: ".mysqli_connect_error());
}

?>