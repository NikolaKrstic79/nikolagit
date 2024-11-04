<?php
// Include the database connection file
include 'db.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get entered username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute a parameterized query to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Compare entered password with the one stored in the database
        if ($password === $user['password']) {
            // Passwords match, proceed with login
            session_start();
            $_SESSION['user_id'] = $user['id'];  // Assuming a user ID is available
            header('Location: dashboard.php');
            exit();
        }
    }

    // Invalid credentials, redirect back to login.php with an error message
    header('Location: login.php?error=InvalidCredentials');
    exit();

    // Close the statement
    $stmt->close();
} else {
    // If the form is not submitted, redirect to login.php
    header('Location: login.php');
    exit();
}

// Close the database connection
$conn->close();
?>
