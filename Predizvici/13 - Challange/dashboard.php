<?php
include 'db.php';

// Check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Check for GET parameters indicating successful form submission
if (isset($_GET['success'])) {
    echo '<div class="alert alert-success mt-3" role="alert">Car information inserted successfully!</div>';
}

// Check if the form is submitted for inserting new car information
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['insert'])) {
    // Retrieve form data
    $vehModel = $_POST['veh_model'];
    $vehType = $_POST['veh_type'];
    $chassNumber = $_POST['chass_number'];
    $prodYear = $_POST['prod_year'];
    $registerNum = $_POST['reg_number'];
    $fuelType = $_POST['fuel_type'];
    $regTo = $_POST['reg_to'];

    // Prepare and execute the insertion query
    $stmt = $conn->prepare("INSERT INTO cars (veh_model, veh_type, chass_number, prod_year, reg_number, fuel_type, reg_to) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssissis', $vehModel, $vehType, $chassNumber, $prodYear, $registerNum, $fuelType, $regTo);

    if ($stmt->execute()) {
        header('Location: dashboard.php?success=1');
        exit();
    } else {
        echo '<div class="alert alert-danger mt-3" role="alert">Error inserting car information: ' . $conn->error . '</div>';
    }
}

// Set the number of records per page
$recordsPerPage = 10;

// Get the current page number
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the starting record for the current page
$start = ($current_page - 1) * $recordsPerPage;

// Initialize $result to avoid undefined variable error
$result = $conn->query("SELECT * FROM cars LIMIT $start, $recordsPerPage");

if (!$result) {
    echo '<div class="alert alert-danger mt-3" role="alert">Error: ' . $conn->error . '</div>';
}

// Check if the search form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
    $searchTerm = $_GET['search'];

    // Modify the query to search for the given term
    $result = $conn->query("SELECT * FROM cars 
                            WHERE veh_model LIKE '%$searchTerm%' 
                               OR veh_type LIKE '%$searchTerm%' 
                               OR chass_number LIKE '%$searchTerm%' 
                               OR prod_year LIKE '%$searchTerm%' 
                               OR reg_number LIKE '%$searchTerm%' 
                               OR fuel_type LIKE '%$searchTerm%'
                               OR reg_to LIKE '%$searchTerm%'");

    if (!$result) {
        echo '<div class="alert alert-danger mt-3" role="alert">Error: ' . $conn->error . '</div>';
    }
}

// Calculate the total number of pages
$total_pages_query = $conn->query("SELECT COUNT(*) FROM cars");
$total_pages = ceil($total_pages_query->fetch_row()[0] / $recordsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Car Management</a>
    <ul class="navbar-nav ml-auto">
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="index.php">Log Out</a>
        </li>
    </ul>
</nav>

<div class="container mt-5">

    <!-- Car Information Form -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Vehicle Registration</h5>
            <form action="dashboard.php" method="post">
                <!-- Input fields for inserting new car information -->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="veh_model">Vehicle Model</label>
                        <input type="text" class="form-control" id="veh_model" name="veh_model" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="veh_type">Vehicle Type</label>
                        <input type="text" class="form-control" id="veh_type" name="veh_type" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="chass_number">Vehicle Chassis Number:</label>
                        <input type="number" class="form-control" id="chass_number" name="chass_number" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="prod_year">Vehicle Production Year:</label>
                        <input type="date" class="form-control" id="prod_year" name="prod_year" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="reg_number">Registration Number:</label>
                        <input type="text" class="form-control" id="reg_number" name="reg_number" required>
                    </div>
                    <div class="form-group col-md-4">
                    <label for="fuel_type">Fuel Type:</label>
                    <select name="fuel_type" id="fuel_type" form="form-control">
                    <option value="benzin">Benzin</option>
                    <option value="plin">Plin</option>
                    <option value="dizel">Dizel</option>
                    <option value="electric">Electric</option>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="reg_to">Registration To:</label>
                        <input type="date" class="form-control" id="reg_to" name="reg_to" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="insert">Insert</button>
            </form>
        </div>
    </div>

    <!-- Search Form -->
    <div class="mb-3">
        <form action="dashboard.php" method="get" class="form-inline">
            <label class="sr-only" for="search">Search</label>
            <input class="form-control mb-2 mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-primary mb-2" type="submit">Search</button>
        </form>
    </div>

    <!-- Car Information Table -->
    <h5>Car Information Table</h5>
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Display all cars
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['veh_model'] . '</td>';
                    echo '<td>' . $row['veh_type'] . '</td>';
                    echo '<td>' . $row['chass_number'] . '</td>';
                    echo '<td>' . $row['prod_year'] . '</td>';
                    echo '<td>' . $row['reg_number'] . '</td>';
                    echo '<td>' . $row['fuel_type'] . '</td>';
                    echo '<td>' . $row['reg_to'] . '</td>';
                    echo '<td>';
                    echo '<a href="edit.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm">Edit</a> ';
                    echo '<a href="delete.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm">Delete</a>';
                    echo '<a href="extend.php?id=' . $row['id'] . '" class="btn btn-success btn-sm">Extend</a>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="7">No records found</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <!-- Pagination Links -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
                echo '<li class="page-item ' . ($i == $current_page ? 'active' : '') . '">';
                echo '<a class="page-link" href="dashboard.php?page=' . $i . '">' . $i . '</a>';
                echo '</li>';
            }
            ?>
        </ul>
    </nav>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
