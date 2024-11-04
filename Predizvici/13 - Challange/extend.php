<?php
include 'db.php';

// Check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Check if the 'id' parameter is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the record from the database based on the provided 'id'
    $stmt = $conn->prepare("SELECT * FROM cars WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // ... (You can display the current information, and provide an input for the extension period)

        // Handle form submission for extending registration
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['extend'])) {
            // Retrieve form data
            $extensionPeriod = $_POST['extension_period']; // You need to replace this with the actual input name

            // Calculate the new registration date based on the extension period
            $currentRegTo = $row['reg_to'];
            $newRegTo = date('Y-m-d', strtotime($currentRegTo . ' +' . $extensionPeriod . ' days'));

            // Update the registration date in the database
            $updateStmt = $conn->prepare("UPDATE cars SET reg_to = ? WHERE id = ?");
            $updateStmt->bind_param('si', $newRegTo, $id);
            $updateStmt->execute();


            if ($updateStmt->execute()) {
                header('Location: dashboard.php?success=1');
                exit();
            } else {
                echo '<div class="alert alert-danger mt-3" role="alert">Error extending registration: ' . $conn->error . '</div>';
            }
        }
    } else {
        echo 'Record not found.';
        exit();
    }
} else {
    echo 'Invalid request.';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extend Registration</title>
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
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="index.php">Log Out</a>
        </li>
    </ul>
</nav>

<div class="container mt-5">

    <!-- Extend Registration Form -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Extend Registration</h5>
            <form action="extend.php?id=<?php echo $id; ?>" method="post">
                <!-- Input field for the extension period -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="extension_period">Extension Period (in days):</label>
                        <input type="number" class="form-control" id="extension_period" name="extension_period" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="extend">Extend</button>
            </form>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
