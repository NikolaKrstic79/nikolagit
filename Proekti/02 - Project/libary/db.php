<?php
$servername = "localhost";
$username = "root";
$password = "spartanac";
$dbname = "library_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
<?php
$pdo = new PDO('mysql:host=localhost;dbname=library_db', 'root', 'spartanac');
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>
<!-- ADMIN PANEL -->
<?php
// Connect to your database (assuming you have a connection established)
$connection = mysqli_connect("localhost", "root", "spartanac", "library_db");

// Check connection
if ($connection === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Query to select if_admin value from users table
$sql = "SELECT if_admin FROM users";

// Execute the query
$result = mysqli_query($connection, $sql);

// Check if query was successful
if ($result) {
    // Fetch the row
    $row = mysqli_fetch_assoc($result);

    // Assuming $if_admin holds the value from the database column
    $if_admin = $row['if_admin'];

    // Close the connection
    mysqli_close($connection);

    // Check if $if_admin is 1, then display the button
    if ($if_admin == 1) {
    }
}
?>
<!-- Comments -->
<?php 
?>
