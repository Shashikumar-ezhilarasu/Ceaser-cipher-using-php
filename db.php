<?php
$servername = "localhost";
$username = "root";  // Change this if using a different user
$password = "300812";
$dbname = "forms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
