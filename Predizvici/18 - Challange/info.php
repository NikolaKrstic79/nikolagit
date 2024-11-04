<?php
session_start();

$name = $_SESSION['name'] ?? '';
$surname = $_SESSION['surname'] ?? '';

// Include the database connection file
include 'db.php';

// Fetch user information from the database
$sql = "SELECT email FROM user_info WHERE name='$name' AND surname='$surname'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found in the database
    $row = $result->fetch_assoc();
    $email = $row['email'];
} else {
    // User not found in the database or email not provided
    $email = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>

    <!-- Style -->
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="bg">

<!-- BANNER -->
<div class="jumbotron jumbotron-fluid text-center text-white bg-transparent ">
      <div class="container">
        <h1 class="display-2 text-white">BUSINESS CASUAL</h1>
      </div>
    </div>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbg">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="./home.php"><b>HOME</b></a>
        </li>
        <?php if (isset($_SESSION['name']) && isset($_SESSION['surname'])): ?>
                <!-- Show logout link if user is logged in -->
                <li class="nav-item">
                    <a class="nav-link" href="./logout.php"><b>LOGOUT</b></a>
                </li>
            <?php else: ?>
                <!-- Show login link if user is not logged in -->
                <li class="nav-item">
                    <a class="nav-link" href="./login.php"><b>LOG IN</b></a>
                </li>
            <?php endif; ?>
      </ul>
    </div>
  </nav>

  <div class="container mt-5">
        <div class="card">
            <div class="card-body navbg text-white ">
                <p class="">Your name is: <?php echo $name; ?></p>
                <p>Your last name is: <?php echo $surname; ?></p>
                <?php if (!empty($email)): ?>
                    <p>Your email is: <?php echo $email; ?></p>
                <?php else: ?>
                    <p> </p> <!-- Show empty if email not provided -->
                <?php endif; ?>
            </div>
        </div>
    </div>


</body>
</html>
