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

    // Retrieve the car information for the given ID
    $stmt = $conn->prepare("SELECT * FROM cars WHERE id = ?");
    $stmt->bind_param('i', $carId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $car = $result->fetch_assoc();
    } else {
        echo '<div class="alert alert-danger mt-3" role="alert">Car not found!</div>';
        exit();
    }

    // Check if the form is submitted for updating the car information
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        // Update the car information in the database
        $vehModel = $_POST['veh_model'];
        $vehType = $_POST['veh_type'];
        $chassNumber = $_POST['chass_number'];
        $prodYear = $_POST['prod_year'];
        $registerNum = $_POST['reg_number'];
        $fuelType = $_POST['fuel_type'];
        $regTo = $_POST['reg_to'];

        $stmt = $conn->prepare("UPDATE cars SET veh_model=?, veh_type=?, chass_number=?, prod_year=?, reg_number=?, fuel_type=?, reg_to=? WHERE id=?");
        $stmt->bind_param('ssissiis', $vehModel, $vehType, $chassNumber, $prodYear, $regNumber, $fuelType, $regTo, $carId);

        if ($stmt->execute()) {
            header('Location: dashboard.php?success=1');
            exit();
        } else {
            echo '<div class="alert alert-danger mt-3" role="alert">Error updating car information: ' . $conn->error . '</div>';
        }
    }
} else {
    echo '<div class="alert alert-danger mt-3" role="alert">Car ID not provided!</div>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car Information</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Car Management</a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php">Home</a>
        </li>
    </ul>
</nav>

<div class="container mt-5">

    <!-- Edit Car Information Form -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Car Information</h5>
            <form action="edit.php?id=<?php echo $carId; ?>" method="post">
                <div class="form-group">
                    <label for="veh_model">Vehicle Model:</label>
                    <input type="text" class="form-control" id="veh_model" name="veh_model" value="<?php echo $car['veh_model']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="veh_type">Vehicle Type:</label>
                    <input type="text" class="form-control" id="veh_type" name="veh_type" value="<?php echo $car['veh_type']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="chass_number">Vehicle Chassis Number:</label>
                    <input type="number" class="form-control" id="chass_number" name="chass_number" value="<?php echo $car['chass_number']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="prod_year">Vehicle Production Year:</label>
                    <input type="date" class="form-control" id="prod_year" name="prod_year" value="<?php echo $car['prod_year']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="reg_number">Registration Number:</label>
                    <input type="text" class="form-control" id="reg_number" name="reg_number" value="<?php echo $car['reg_number']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="fuel_type">Fuel Type:</label>
                    <input type="text" class="form-control" id="fuel_type" name="fuel_type" value="<?php echo $car['fuel_type']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="reg_to">Registration To:</label>
                    <input type="date" class="form-control" id="reg_to" name="reg_to" value="<?php echo $car['reg_to']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </form>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
