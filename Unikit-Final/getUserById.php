<?php

include("connection.php");

$user_id = $_GET["id"];

$query = "SELECT * FROM users WHERE id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$results = $stmt->get_result();
$user = $results->fetch_assoc();

$json = json_encode($user);
print $json;

?>