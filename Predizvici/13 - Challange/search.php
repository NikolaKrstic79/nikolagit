<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Results</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <?php
  // Check if the license plate is submitted
  if (isset($_POST['registerNum'])) {
      $licensePlate = $_POST['registerNum'];
      // You can implement your own logic for searching the license plate in a database or another data source

      // For demonstration purposes, just display the entered license plate
      echo '<div class="alert alert-success" role="alert">';
      echo 'Search results for register number: ' . htmlspecialchars($licensePlate);
      echo '</div>';
  } else {
      // If no license plate is submitted, redirect back to index.php
      header('Location: index.php');
      exit();
  }
  ?>
</div>

<!-- Bootstrap JS and dependencies (jQuery and Popper.js) -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>