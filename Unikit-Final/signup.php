<?php

include("connection.php");

if(isset($_POST["full_name"]) && $_POST["full_name"] != ""){
	$full_name = $_POST["full_name"];
}else{
	die("Full Name must not be empty!");
}

if(isset($_POST["email"]) && $_POST["email"] != ""){
	$email = $_POST["email"];
}else{
	die("Email must not be empty!");
}

$select = mysqli_query($connection, "SELECT `email` FROM `users` WHERE `email` = '".$_POST['email']."'") or exit(mysqli_error($connection));
if(mysqli_num_rows($select)) {
    die('This email is already being used');
}


if(isset($_POST["password"]) && $_POST["password"] != ""){
	$password = hash("sha256", $_POST["password"]);
}else{
	die("Password must not be empty!");
}

if(isset($_POST["phone_number"]) && $_POST["phone_number"] != ""){
	$phone_number = $_POST["phone_number"];
}else{
	die("Phone number must not be empty!");
}

$select = mysqli_query($connection, "SELECT `phone_number` FROM `users` WHERE `phone_number` = '".$_POST['phone_number']."'") or exit(mysqli_error($connection));
if(mysqli_num_rows($select)) {
    die('This phone number is already being used');
}

$mysql = $connection->prepare("INSERT INTO users(email, password,full_name,phone_number) VALUES (?,?,?,?)");
$mysql->bind_param("ssss", $email, $password, $full_name, $phone_number);
$mysql->execute();

$mysql->close();
$connection->close();
echo "Success!";

?>