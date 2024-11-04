<?php
include 'db.php';

// Check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    $carId = $_GET['id'];

    // Delete the car information from the database
    $stmt = $conn->prepare("DELETE FROM cars WHERE id = ?");
    $stmt->bind_param('i', $carId);

    if ($stmt->execute()) {
        header('Location: dashboard.php?success=1');
        exit();
    } else {
        echo '<div class="alert alert-danger mt-3" role="alert">Error deleting car information: ' . $conn->error . '</div>';
    }
} else {
    echo '<div class="alert alert-danger mt-3" role="alert">Car ID not provided!</div>';
    exit();
}
?>
