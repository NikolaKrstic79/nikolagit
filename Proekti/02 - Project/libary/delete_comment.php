<?php
session_start();

include "db/db.php";

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo 'You must be logged in to delete a comment';
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['commentId'])) {
        $commentId = $_POST['commentId'];

        $stmt = $conn->prepare("DELETE FROM approved_comments WHERE id = ?");
        $stmt->bind_param("i", $commentId);

        if ($stmt->execute()) {
            echo 'Comment deleted successfully';
        } else {
            http_response_code(500);
            echo 'Failed to delete comment';
        }

        $stmt->close();
    } else {
        http_response_code(400);
        echo 'Bad request';
    }
} else {
    http_response_code(405);
    echo 'Method not allowed';
}

$conn->close();
?>
