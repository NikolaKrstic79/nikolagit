<?php
session_start();

include "db.php";

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo 'You must be logged in to add a comment';
    exit();
}


if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST['commentContent']) && isset($_POST['bookId'])){
        $bookId = $_POST['bookId'];
        $commentContent = $_POST['commentContent'];

        $stmt = $conn->prepare("INSERT INTO held_comments (user_id, book_id, content) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $_SESSION['user_id'], $bookId, $commentContent);
        if($stmt->execute()){
            echo 'Comment submitted successfully';
        } else{
            echo 'Failed to submit comment';
        }
        $stmt->close();
    } else{
        http_response_code(400);
        echo 'Bad request';
    }
} else{
    http_response_code(405);
    echo 'Method not allowed';
}
$conn->close();
?>