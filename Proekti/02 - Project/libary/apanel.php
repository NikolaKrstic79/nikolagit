<?php
session_start();
include "db.php";
include "userhandler.php";

$stmt = $conn->prepare("SELECT held_comments.id, users.username, books.title, held_comments.content 
                        FROM held_comments 
                        INNER JOIN users ON held_comments.user_id = users.id 
                        INNER JOIN books ON held_comments.book_id = books.id");
$stmt->execute();
$result = $stmt->get_result();
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
              <a class="nav-link text-dark navfont" href="./index.php"> <b>Go Home</b></a>
            </li>
            <li class="nav-item">
            </li>
<!-- ADMIN PANEL -->
<li class="nav-item">  
  
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
        <h2 class="display-5 text-dark">ADMIN PANEL</h2>
        <hr />
        <p class="lead text-dark">Пријатно работно време администратору :)</p>
      </div>
    </div>
<!-- ADMIN PANEL FUNCTIONS -->

<!-- ADD BOOK -->
<div class="container mt-5">
  <h2 class="m-4 text-center">Add Book</h2>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form action="admin_actions.php" method="post">
        <div class="form-group">
          <label for="title">Title:</label>
          <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
          <label for="author">Author:</label>
          <input type="text" class="form-control" id="author" name="author">
        </div>
        <div class="form-group">
          <label for="category">Category:</label>
          <input type="text" class="form-control" id="category" name="category">
        </div>
        <div class="form-group">
          <label for="image_url">Image URL:</label>
          <input type="text" class="form-control" id="image_url" name="image_url">
        </div>
        <div class="form-group">
          <label for="description">Description:</label>
          <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
          <label for="bio">Author Bio:</label>
          <textarea class="form-control" id="bio" name="bio"></textarea>
        </div>
        <div class="form-group">
          <label for="releases">Release Year:</label>
          <input type="text" class="form-control" id="releases" name="releases">
        </div>
        <div class="form-group">
          <label for="pages">Pages:</label>
          <input type="text" class="form-control" id="pages" name="pages">
        </div>
        <button type="submit" class="btn btn-primary btn-block" name="add_book">Add Book</button>
      </form>
    </div>
  </div>
</div>


<!-- ALL BOOKS -->
<div class="container">
    <h2 class="mt-5 text-center">All Books</h2>
    <div class="row">
        <?php
        include 'db.php'; // Include Database Connection

        // SQL Query to fetch books data
        $sql = "SELECT * FROM books";
        $result = $conn->query($sql);

        // Fetch and display books data in Bootstrap cards
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-3 mb-4">';
                echo '<div class="card h-100">';
                echo '<img src="'.$row["image_url"].'" class="card-img-top" alt="Book Image">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">'.$row["title"].'</h5>';
                echo '<p class="card-text">Author: '.$row["author"].'</p>';
                echo '<p class="card-text">Category: '.$row["category"].'</p>';
                echo '<a href="edit.php?id='.$row["id"].'" class="btn btn-primary">Edit</a>';
                echo '<a href="deletebook.php?id='.$row["id"].'" class="btn btn-danger">Delete</a>';
                echo '</div></div></div>';
            }
        } else {
            echo '<div class="col-12 text-center">0 results</div>';
        }
        $conn->close();
        ?>
    </div>
</div>

<!-- COMMENTS -->
<section style="border: 4px solid yellow;">
      <div id="comment-dash">
        <h2>Held Comments</h2>
        <ul>
          <?php while ($comment = $result->fetch_assoc()) : ?>
            <li>
              <p>User: <?php echo $comment['user_username']; ?></p>
              <p>Book: <?php echo $comment['book_title']; ?></p>
              <p>Comment: <?php echo $comment['content']; ?></p>
              <form action="approve_comment.php" method="post">
                <input type="hidden" name="commentId" value="<?php echo $comment['id']; ?>">
                <button type="submit" name="approveComment">Approve</button>
                <button type="submit" name="rejectComment">Reject</button>
              </form>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
    </section>
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

    <script>
  $(document).ready(function() {
    function handleCommentAction(commentId, action) {
      $.ajax({
        url: "approve_comment.php",
        type: "POST",
        data: {
          commentId: commentId,
          [action]: true
        },
        success: function(response) {
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: response,
          }).then(function() {
            location.reload();
          });
        },
        error: function(xhr, status, error) {
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Failed to perform action',
          });
          console.error(error);
        }
      });
    }

    $("button[name='approveComment']").click(function(e) {
      e.preventDefault();
      console.log("Approve button clicked");
      var commentId = $(this).closest("form").find("input[name='commentId']").val();
      handleCommentAction(commentId, "approveComment");
    });

    $("button[name='rejectComment']").click(function(e) {
      e.preventDefault();
      console.log("Reject button clicked");
      var commentId = $(this).closest("form").find("input[name='commentId']").val();
      handleCommentAction(commentId, "rejectComment");
    });
  });
</script>

  </body>
</html> 