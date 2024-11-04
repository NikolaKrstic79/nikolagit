<?php
// Include the database connection file
include 'db.php';

session_start();

$name = $surname = $email = "";
$nameErr = $surnameErr = $emailErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "The name field is required.";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z]{1,15}$/",$name)) {
            $nameErr = "Name must consist of only letters and cannot contain more than 15 characters";
        }
    }
    
    if (empty($_POST["surname"])) {
        $surnameErr = "The lastname field is required.";
    } else {
        $surname = test_input($_POST["surname"]);
        if (!preg_match("/^[a-zA-Z]{1,25}$/",$surname)) {
            $surnameErr = "Surname must consist of only letters and cannot contain more than 25 characters";
        }
    }
    
    if (!empty($_POST["email"])) {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "The email must be a valid email address.";
        }
    }
    
    if (empty($nameErr) && empty($surnameErr) && empty($emailErr)) {
        // SQL query to insert data into the database
        $sql = "INSERT INTO user_info (name, surname, email) VALUES ('$name', '$surname', '$email')";
        
        // Execute the query
        if (execute_query($sql)) {
            // Set session variables for logged-in user
            $_SESSION['name'] = $name;
            $_SESSION['surname'] = $surname;
            // Set email session variable only if provided
            if (!empty($email)) {
                $_SESSION['email'] = $email;
            }

            // Redirect to info.php
            header("Location: home.php");
            exit();
        } else {
            // Error inserting data
            echo "Error: " . $conn->error;
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- STYLE -->
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--  -->
    <title>Document</title>
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
        <li class="nav-item">
          <a class="nav-link" href="#"><b>LOG IN</b></a>
        </li>
      </ul>
    </div>
  </nav>
    <!-- FORM -->
    <div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card bg-transparent">
        <div class="card-body">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <!-- NAME -->
            <div class="form-group text-white">
              <label for="name"><h4><b>NAME</b></h4></label>
              <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name);?>">
              <span class="error"><?php echo !empty($nameErr) ? htmlspecialchars($nameErr) : ''; ?></span>
            </div>
            <!-- SURNAME -->
            <div class="form-group text-white">
              <label for="surname"><h4><b>SURNAME</b></h4></label>
              <input type="text" class="form-control" id="surname" name="surname" value="<?php echo htmlspecialchars($surname);?>">
              <span class="error"><?php echo !empty($surnameErr) ? htmlspecialchars($surnameErr) : ''; ?></span>
            </div>
            <!-- EMAIL -->
            <div class="form-group text-white">
              <label for="surname"><h4><b>EMAIL</b></h4></label>
              <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email);?>">
              <span><?php echo $emailErr;?></span>
            </div>
            <!-- SUBMIT -->
            <button type="submit" class="btn btn-primary p-2" name="submit">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


    <!-- FOOTER -->
<footer class="navbg text-center p-5 mt-5">
        <h1 class="display-5 text-white">Copyright &copy; Your Website 2018</h1>
</footer>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>