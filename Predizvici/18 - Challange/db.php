<?php

$servername = "localhost"; // Change this if your database is hosted on a different server
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$dbname = "user_info"; // Change this to the name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to execute SQL queries
function execute_query($sql) {
    global $conn;
    if ($conn->query($sql) === TRUE) {
        return true; // Query executed successfully
    } else {
        return false; // Error executing query
    }
}

// Function to fetch data from a table
function fetch_data($sql) {
    global $conn;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC); // Fetching data as associative array
    } else {
        return []; // No records found
    }
}

?>
