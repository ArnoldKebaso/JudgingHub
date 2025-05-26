<?php
// Database connection setup
$host = 'db';
$user = 'root';
$password = 'lamp_stack';
$database = 'competition';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>