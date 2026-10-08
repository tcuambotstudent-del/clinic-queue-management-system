<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "clinic_queue";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
if ($conn) {
    echo "Connection Successfull";
}

$conn->set_charset("utf8mb4");

?>
