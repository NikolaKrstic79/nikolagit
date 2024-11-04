<?php
// Include database connection
include 'db.php';

// Check if book ID is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize book ID
    $book_id = $_GET['id'];

    // SQL query to delete the book from the database
    $sql = "DELETE FROM books WHERE id=?";

    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    
    if ($stmt->execute()) {
        // Book successfully deleted
        echo "Book deleted successfully";
    } else {
        // Error occurred while deleting the book
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
        // Redirect back to apanel.php
        header("Location: apanel.php");
        exit();
} else {
    // No book ID provided
    echo "No book ID provided";
}

// Close database connection
$conn->close();
?>
