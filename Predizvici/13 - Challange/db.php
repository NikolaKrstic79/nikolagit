<?php

// Database connection parameters
$host = "localhost:4306";
$username = "root";
$password = "";
$dbname = "plate_search";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
