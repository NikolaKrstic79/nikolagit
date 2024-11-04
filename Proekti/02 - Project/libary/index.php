<?php
session_start();
include "./db.php";

include "./fetchbooks.php";
?>  
<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />

    <link
      rel="stylesheet"
      href="path/to/font-awesome/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="style.css" />

    <title>Document</title>
  </head>
  <body class="ffont">
    <!-- NAVBAR -->

    <nav class="navbar navbar-expand-lg yellowbg sitebg">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"
          ><img src="./images/logonav.png" alt="NavLogo.png"
        /></a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link text-dark navfont" href="./index.php"> <b>Home</b></a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark navfont" href="#"><b>Links</b></a>
            </li>
<!-- ADMIN PANEL -->
<li class="nav-item">  
<?php
// Check if the session variable 'if_admin' is set and equals 1
if (isset($_SESSION['if_admin']) && $_SESSION['if_admin'] == 1) {
  echo '<a href="apanel.php" class="btn btn-outline-dark my-2 my-sm-0">Admin Panel</a>';
} 

// Debugging: Output the value of $_SESSION['if_admin'] if it exists
if (isset($_SESSION['if_admin'])) {
  // echo "if_admin value: " . $_SESSION['if_admin'] . "<br>";
} else {
  // echo "if_admin is not set.<br>";
}
?>
</li>
          </ul>
          <!-- WELCOME FORM -->
          <form class="form-inline my-2 my-lg-0">
                    <li class="nav-item">
                        <?php
                        if (isset($_SESSION['username'])) {
                            echo '<span class="text-dark navfont">Welcome ' . $_SESSION['username'] . '|</span>';
                            echo '<a href="logout.php" class="btn btn-outline-dark my-2 my-sm-0">Logout</a>';
                        } else {
                            echo '<span class="text-dark navfont">Welcome Guest |</span>';
                            echo '<button id="loginBtn" class="btn btn-outline-dark my-2 my-sm-0" type="button">LogIn/SignUp</button>';
                        }
                        ?>
                    </li>
                </form>
          <!--  -->
      </div>
    </nav>
    <!-- BANNER -->
    <div class="jumbotron jumbotron-fluid text-center yellowbg text-white">
      <div class="container">
        <h1 class="display-4 text-dark">SPARTA LIBRARY</h1>
        <hr />
        <p class="lead text-dark">Добредојдовте во нашата библиотека :)</p>
      </div>
    </div>

   <!-- SEARCH -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <input type="text" class="form-control" id="searchInput" onkeyup="searchBooks()" placeholder="Search for books by title, author, or category">
        </div>
    </div>
    <!-- BOOKS -->
<div class="row mt-4" id="bookCards">
    <!-- PHP Code to Fetch and Display Books -->
    <?php
    include 'db.php'; // Include Database Connection

    // SQL Query to fetch books data
    $sql = "SELECT * FROM books";
    $result = $conn->query($sql);

    // Fetch and display books data in Bootstrap cards
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-3 mb-4">';
            echo '<a href="books.php?id='.$row["id"].'">'; // Add unique book ID to the URL
            echo '<div class="card h-100">';
            echo '<img src="'.$row["image_url"].'" class="card-img-top" alt="Book Image">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">'.$row["title"].'</h5>';
            echo '<p class="card-text">Author: '.$row["author"].'</p>';
            echo '<p class="card-text">Category: '.$row["category"].'</p>';
            echo '</div></div></a></div>';
        }
    } else {
        echo '<div class="col-12 text-center">0 results</div>';
    }
    $conn->close();
    ?>
</div>
<!-- Footer -->



    <!-- END -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
    <script src="main.js"></script>
  </body>
</html> 