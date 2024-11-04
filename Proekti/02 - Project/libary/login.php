<?php
session_start();

// Include the database connection file
include_once('db.php');

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($_POST['form_type'] == 'login') {
        loginUser($conn, $username, $password);
    } elseif ($_POST['form_type'] == 'signup') {
        $email = $_POST['email'];
        registerUser($conn, $username, $password, $email);
    }
}

// Function to handle user login
function loginUser($conn, $username, $password) {
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // // Debug output: Print retrieved user data
        // echo "<pre>";
        // print_r($user);
        // echo "</pre>";
        
        // Login successful, set the session variables
        $_SESSION['username'] = $user['username'];
        $_SESSION['if_admin'] = $user['if_admin']; // Assuming 'if_admin' represents admin status in your database
        $_SESSION['user_id'] = $user['id'];
        
        // // Debug output: Print session data
        // echo "Session data: <pre>";
        // print_r($_SESSION);
        // echo "</pre>";
        
        // Redirect to index.php    
        header("Location: index.php");
        exit();
    } else {
        echo "Login failed. Invalid username or password.";
    }
}



// Function to handle user registration
function registerUser($conn, $username, $password, $email) {
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center mb-4">Login / Sign Up</h2>

                <!-- Login Form -->
                <form action="" method="post" id="loginForm">
                    <input type="hidden" name="form_type" value="login">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
                    <p class="mt-3 text-center">Don't have an account? <a href="javascript:void(0);" onclick="showSignUpForm()">Sign Up</a></p>
                    <p class="text-center mt-3"><a href="javascript:void(0);" onclick="goBack()">Go Back</a></p>
                </form>

                <!-- Sign Up Form -->
                <form action="" method="post" id="signUpForm" style="display: none;">
                    <input type="hidden" name="form_type" value="signup">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success btn-block">Sign Up</button>
                    <p class="mt-3 text-center">Already have an account? <a href="javascript:void(0);" onclick="showLoginForm()">Login</a></p>
                    <p class="text-center mt-3"><a href="javascript:void(0);" onclick="goBack()">Go Back</a></p>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (Optional) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript for form toggling -->
<!-- Include main.js -->
<script src="main.js"></script>

</body>
</html>
