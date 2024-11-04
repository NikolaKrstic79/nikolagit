<?php
include 'db.php'; // Include Database Connection

// Check if book ID is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize book ID
    $book_id = $_GET['id'];

    // SQL query to fetch the details of the selected book
    $sql = "SELECT * FROM books WHERE id=?";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Book found, display edit form
        $book = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Book</title>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <body>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center">Edit Book</h3>
                            </div>
                            <div class="card-body">
                            <form action="admin_actions.php" method="post">
    <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
    <div class="form-group">
        <h5>Book Title:</h5>
        <input type="text" class="form-control" name="title[]" value="<?php echo $book['title']; ?>" placeholder="Title">
    </div>
    <div class="form-group">
        <h5>Author:</h5>
        <input type="text" class="form-control" name="author[]" value="<?php echo $book['author']; ?>" placeholder="Author">
    </div>
    <div class="form-group">
        <h5>Book Category:</h5>
        <input type="text" class="form-control" name="category[]" value="<?php echo $book['category']; ?>" placeholder="Category">
    </div>
    <div class="form-group">
        <h5>Image URL:</h5>
        <input type="text" class="form-control" name="image_url[]" value="<?php echo $book['image_url']; ?>" placeholder="Image URL">
    </div>
    <div class="form-group">
        <h5>Book Short Description:</h5>
        <textarea class="form-control" name="description[]" placeholder="Description"><?php echo $book['description']; ?></textarea>
    </div>
    <div class="form-group">
        <h5>Book Short Bio:</h5>
        <textarea class="form-control" name="bio[]" placeholder="Author Bio"><?php echo $book['bio']; ?></textarea>
    </div>
    <div class="form-group">
        <h5>Book Release Year:</h5>
        <input type="text" class="form-control" name="releases[]" value="<?php echo $book['releases']; ?>" placeholder="Release Year">
    </div>
    <div class="form-group">
        <h5>Book Pages:</h5>
        <input type="text" class="form-control" name="pages[]" value="<?php echo $book['pages']; ?>" placeholder="Pages">
    </div>
    <button type="submit" class="btn btn-primary btn-block" name="edit_books">Save Changes</button>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    } else {
        // Book not found
        echo "Book not found";
    }

    // Close the statement
    $stmt->close();
} else {
    // No book ID provided
    echo "No book ID provided";
}

// Close database connection
$conn->close();
?>
