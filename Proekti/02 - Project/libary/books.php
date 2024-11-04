<?php
session_start();

include "./db.php";
include "./fetchbooks.php";
include "./userhandler.php";

if (!isset($_GET['id']) || $_GET['id'] == '') {
  http_response_code(405);
  echo "Method not allowed";
  exit();
}

$bookId = $_GET['id'];


// $sql = "SELECT * FROM books WHERE id = $bookId";
// $result = $conn->query($sql);

// $bookInfo = $result->fetch_assoc();


$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
$stmt->bind_param("i", $bookId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $bookInfo = $result->fetch_assoc();

  $stmt = $conn->prepare("SELECT * FROM notes WHERE note_book_id = ?");
  $stmt->bind_param("i", $bookId);
  $stmt->execute();
  $notesResult = $stmt->get_result();

  $stmt = $conn->prepare("SELECT approved_comments.id, approved_comments.content, users.username FROM approved_comments INNER JOIN users ON approved_comments.user_id = users.id WHERE approved_comments.book_id = ?");

  $stmt->bind_param("i", $bookId);
  $stmt->execute();
  $commentsResult = $stmt->get_result();
} else {
  http_response_code(404);
  echo 'Book not found';
  exit();
}


$conn->close();
?>


<!doctype html>
<html lang="en">

<head>
  <title>Library</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="style.css">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
  <header>
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
              <a class="nav-link text-dark navfont" href="./index.php"> <b>Home |</b></a>
            </li> 
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
          </ul>
      </div>
      </div>
    </nav>
        
    <!-- CARDS -->
    <main>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-4">
          <!-- Book Information -->
          <div class="card">
            <img src="<?php echo $bookInfo['image_url'] ?>" class="card-img-top" alt="Book Cover">
            <div class="card-body">
              <h5 class="card-title">Book Title: <?php echo $bookInfo['title']; ?></h5>
              <p class="card-text">Author: <?php echo $bookInfo['author']; ?></p>
              <p class="card-text">Release Date: <?php echo $bookInfo['releases']; ?></p>
              <p class="card-text">Number Of Pages: <?php echo $bookInfo['pages']; ?></p>
              <p class="card-text">Book Category: <?php echo $bookInfo['category']; ?></p>
              <p class="card-text">Short Description Of The Book:</p>
              <p class="card-text"><?php echo $bookInfo['description']; ?></p>
              <p class="card-text">Short Bio About The Author:</p>
              <p class="card-text"><?php echo $bookInfo['bio']; ?></p>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <!-- Notes -->
          <div class="card">
            <div class="card-body">
              <?php if ($loggedIn) : ?>
                <h5 class="card-title">Add Note</h5>
                <form id="noteForm">
                  <input type="hidden" id="bookId" name="bookId" value="<?php echo $bookId; ?>">
                  <textarea class="form-control" id="noteContent" rows="4" cols="50" placeholder="Enter your note here"></textarea>
                  <br>
                  <button type="button" class="btn btn-primary" id="submitNote">Submit Note</button>
                </form>
              <?php endif; ?>

              <h5 class="card-title mt-4">Notes</h5>
              <div id="notesContainer">
                <?php if ($notesResult->num_rows > 0) : ?>
                  <ul class="list-group list-group-flush">
                    <?php while ($note = $notesResult->fetch_assoc()) : ?>
                      <li class="list-group-item" id="note_<?php echo $note['note_id']; ?>">
                        <?php echo $note['note_content']; ?>
                        <?php if ($loggedIn && $note['note_user_id'] === $_SESSION['user_id']) : ?>
                          <button class="btn btn-danger deleteNote" data-noteid="<?php echo $note['note_id']; ?>">Delete</button>
                        <?php endif; ?>
                      </li>
                    <?php endwhile; ?>
                  </ul>
                <?php else : ?>
                  <p>No notes added for this book yet.</p>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Comments -->
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <div id="commentDivId">
            <?php if ($loggedIn) : ?>
              <h2>Add Comment</h2>
              <form id="commentForm">
                <input type="hidden" id="bookId" name="bookId" value="<?php echo $bookId; ?>">
                <textarea class="form-control" id="commentContent" name="commentContent" rows="4" cols="50" placeholder="Enter your comment here"></textarea>
                <br>
                <button type="submit" class="btn btn-primary" id="submitComment">Submit Comment</button>
              </form>
            <?php endif; ?>

            <h2 class="mt-4">Comments</h2>
            <?php if ($commentsResult->num_rows > 0) : ?>
              <ul class="list-group list-group-flush">
                <?php while ($comment = $commentsResult->fetch_assoc()) : ?>
                  <li class="list-group-item">
                    <strong><?php echo $comment['user_username']; ?>:</strong> <?php echo $comment['content']; ?>
                    <button class="btn btn-danger deleteComment" data-commentid="<?php echo $comment['id']; ?>">Delete</button>
                  </li>
                <?php endwhile; ?>
              </ul>
            <?php else : ?>
              <p>No comments added for this book yet.</p>
            <?php endif; ?>

          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Bootstrap JavaScript Libraries -->

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

  <script src="main.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      fetchQuote();
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>