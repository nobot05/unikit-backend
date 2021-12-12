<?php

$server = "localhost";
$username = "phpmyadmin";
$password = "234432";
$dbname = "phpmyadmin";

$connection = new mysqli($server, $username, $password, $dbname);

if($connection->connect_error){
	die("Failed");
}

?>