<?php
include 'db.php';

// Check if the form is submitted for searching
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
    $searchTerm = $_GET['search'];

    // Check if the search term is empty
    if (empty($searchTerm)) {
        echo '<div class="alert alert-danger mt-3" role="alert">Please enter a license plate to search.</div>';
    } else {
        // Query to search for the given license plate
        $result = $conn->query("SELECT * FROM cars WHERE reg_number LIKE '%$searchTerm%'");

        if (!$result) {
            echo '<div class="alert alert-danger mt-3" role="alert">Error: ' . $conn->error . '</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Registration</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Vehicle Registration</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="login.php">LogIn</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">

    <!-- Search Card -->
    <div class="card text-center ">
        <div class="card-body">
            <h5 class="card-title">Vehicle Registration</h5>
            <h6 class="card-subtitle mb-2 text-muted">Enter your registration number to check its validity</h6>
            <form action="index.php" method="get" class="form-inline">
                <div class="form-group">
                    <label class="sr-only" for="search">Registration number</label>
                    <input class="form-control mb-2 mr-sm-2" type="text" placeholder="Registration number" aria-label="Search" name="search">
                </div>
                <button class="btn btn-primary mb-2" type="submit">Search</button>
            </form>
        </div>
    </div>

    <!-- Car Information Table -->
    <?php if (isset($result) && $result->num_rows > 0): ?>
        <h5>Car Information</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Vehicle Model</th>
                    <th>Vehicle Type</th>
                    <th>Vehicle Chassis Number</th>
                    <th>Vehicle Production Year</th>
                    <th>Registration Number</th>
                    <th>Fuel Type</th>
                    <th>Registration To</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['veh_model'] . '</td>';
                    echo '<td>' . $row['veh_type'] . '</td>';
                    echo '<td>' . $row['chass_number'] . '</td>';
                    echo '<td>' . $row['prod_year'] . '</td>';
                    echo '<td>' . $row['reg_number'] . '</td>';
                    echo '<td>' . $row['fuel_type'] . '</td>';
                    echo '<td>' . $row['reg_to'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    <?php elseif (isset($result)): ?>
        <p>No results found for the given license plate.</p>
    <?php endif; ?>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
