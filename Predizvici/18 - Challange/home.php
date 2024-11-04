<?php
session_start();

// Include the database connection file
include 'db.php';

$name = $_SESSION['name'] ?? '';

// Fetch user information from the database if user is logged in
if(isset($_SESSION['email']) && isset($_SESSION['surname'])) {
    $email = $_SESSION['email'];
    $surname = $_SESSION['surname'];

    $sql = "SELECT name FROM user_info WHERE email='$email' AND surname='$surname'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
    }
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
                <a class="nav-link" href="#"><b>HOME</b></a>
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
            <li class="nav-item">
                <a class="nav-link" href="./info.php"><b>INFO</b></a>
            </li>
        </ul>
    </div>
</nav>

<!-- CONTENT -->
<div class="container mt-5 "> 
    <div class="row"> 
    <div class="col-6"> 
        <div class="card cardpos">
          <div class="card-body text-center">
            <h5 class="card-title">Lorem, ipsum.</h5>
            <p class="card-subtitle">Lorem, ipsum.</p>
            <div class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio aliquam dolorem temporibus vero rerum ab numquam? Omnis cupiditate at inventore unde perferendis quibusdam repudiandae asperiores, odio est eum, rerum amet vero corporis sed in sint expedita nihil eos? Natus ipsum deserunt maiores distinctio doloremque repellat modi. Nisi reprehenderit cum nam.
            </div>
            <div>
            <button class="yellowbg btn">Visit us today</button>
            </div>
          </div>
        </div>
            </div> 
        <div class="col-6"> 
        <img src="./Images/cafe.jpg" alt="" width="120%">
            </div> 
        </div> 
    </div>



  <!-- BANNER2 -->
<div class="container yellowbg mt-5 p-5">
<div class="contaner blond text-center p-3 ">
<h2>OUR PROMISE</h2>
<h2><?php echo isset($_SESSION['name']) && isset($_SESSION['surname']) ? $name . ' ' . $_SESSION['surname'] : 'TO YOU'; ?></h2>

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique molestias alias assumenda tempora praesentium magni nobis totam accusantium expedita dolorum nemo debitis inventore nulla consequuntur autem voluptates, itaque adipisci aliquam, maxime labore unde! At laborum quae deleniti aut consectetur recusandae, animi quasi eos earum officia doloribus veniam tenetur cumque sint enim necessitatibus assumenda quis reprehenderit corporis! Incidunt sit, sed laborum accusantium repellendus quisquam eos, dolorem sunt alias corporis esse vero molestiae ratione iusto eligendi error laudantium non saepe doloremque similique explicabo tempore nostrum accusamus soluta. Ea porro dignissimos fugit dolorem, adipisci quam blanditiis tenetur quidem temporibus deserunt exercitationem nostrum modi?</p>

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
