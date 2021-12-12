<?php

include("connection.php");

if(isset($_POST["email"]) && $_POST["email"] != ""){
	$email = $_POST["email"];
}else{
	die("Email must not be empty!");
}

if(isset($_POST["password"]) && $_POST["password"] != ""){
	$password = hash("sha256", $_POST["password"]);
}else{
	die("Password must not be empty!");
}

$select = mysqli_query($connection, "SELECT `email` FROM `users` WHERE `email` = '".$_POST['email']."'") or exit(mysqli_error($connection));
if(!mysqli_num_rows($select)) {
    die('Invalid email or password');
}

$select = $connection->prepare("SELECT `id,password` FROM `users` WHERE `email` = '".$_POST['email']."'");
$select->execute();

$results = $select->get_result();
while ($data = $results->fetch_assoc()) {
    $result[] = $data;
}

$select->close();

if ($password == $result[0]['password']) {
    echo $result[0]['id'];
} else {
    echo 'Invalid email or password';
}

?>