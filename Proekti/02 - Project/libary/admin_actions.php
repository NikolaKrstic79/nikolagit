<?php
// Include database connection
include 'db.php';

// Function to sanitize input data
function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if form is submitted for adding a book
if(isset($_POST['add_book'])) {
    // Sanitize form inputs
    $title = sanitize($_POST['title']);
    $author = sanitize($_POST['author']);
    $category = sanitize($_POST['category']);
    $image_url = sanitize($_POST['image_url']);
    $description = sanitize($_POST['description']);
    $bio = sanitize($_POST['bio']);
    $releases = sanitize($_POST['releases']);
    $pages = sanitize($_POST['pages']);
    
    // SQL query to insert the book into the database
    $sql = "INSERT INTO books (title, author, category, image_url, description, bio, releases, pages) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $title, $author, $category, $image_url, $description, $bio, $releases, $pages);
    if ($stmt->execute()) {
        echo "Book added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();

    // Redirect back to apanel.php
    header("Location: apanel.php");
    exit();
}

// Check if form is submitted for editing books
if(isset($_POST['edit_books'])) {
    // Get form data
    $book_ids = (array)$_POST['book_id']; // Cast to array to ensure it's an array
    $titles = $_POST['title'];
    $authors = $_POST['author'];
    $categories = $_POST['category'];
    $image_urls = $_POST['image_url'];
    $descriptions = $_POST['description'];
    $bios = $_POST['bio'];
    $releases = $_POST['releases'];
    $pages = $_POST['pages'];

    // Debug: Output form data to check if they are arrays
    var_dump($book_ids, $titles, $authors, $categories, $image_urls, $descriptions, $bios, $releases, $pages);

    // Prepare an SQL statement for updating books
    $sql = "UPDATE books 
            SET title=?, author=?, category=?, image_url=?, description=?, bio=?, releases=?, pages=? 
            WHERE id=?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
    } else {
        // Loop through each book and update its information
        foreach ($book_ids as $key => $book_id) {
            // Loop through each book and update its information
for ($i = 0; $i < count($book_ids); $i++) {
    // Assign array elements to temporary variables
    $title = isset($titles[$i]) ? $titles[$i] : '';
    $author = isset($authors[$i]) ? $authors[$i] : '';
    $category = isset($categories[$i]) ? $categories[$i] : '';
    $image_url = isset($image_urls[$i]) ? $image_urls[$i] : '';
    $description = isset($descriptions[$i]) ? $descriptions[$i] : '';
    $bio = isset($bios[$i]) ? $bios[$i] : '';
    $release = isset($releases[$i]) ? $releases[$i] : '';
    $page = isset($pages[$i]) ? $pages[$i] : '';

    // Bind parameters to the statement
    $stmt->bind_param("ssssssisi", $title, $author, $category, $image_url, $description, $bio, $release, $page, $book_ids[$i]);
    
    // Execute the statement
    if (!$stmt->execute()) {
        echo "Error updating book with ID " . $book_ids[$i] . ": " . $stmt->error;
    }
}


            
            // Execute the statement
            if (!$stmt->execute()) {
                echo "Error updating book with ID " . $book_id . ": " . $stmt->error;
            }
        }
        
        // Close the statement
        $stmt->close();

        // Redirect back to apanel.php
        header("Location: apanel.php");
        exit();
    }
}



// Check if form is submitted for deleting a book
if(isset($_POST['delete_book'])) {
    // Sanitize form inputs
    $book_id = sanitize($_POST['book_id']);
    
    // SQL query to delete the book from the database
    $sql = "DELETE FROM books WHERE id=?";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    if ($stmt->execute()) {
        echo "Book deleted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();

    // Redirect back to apanel.php
    header("Location: apanel.php");
    exit();
}

// Close database connection
$conn->close();
?>
