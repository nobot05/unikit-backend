<?php

include("connection.php");

$query = "SELECT * FROM users ORDER BY id DESC";
$stmt = $connection->prepare($query);
$stmt->execute();
$results = $stmt->get_result();

?>