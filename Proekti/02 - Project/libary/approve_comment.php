<?php
session_start();

include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['commentId'])) {
    $commentId = $_POST['commentId'];

    $stmt = $conn->prepare("SELECT * FROM held_comments WHERE id = ?");
    $stmt->bind_param("i", $commentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $comment = $result->fetch_assoc();
        if (isset($_POST['approveComment'])) {
            $stmt = $conn->prepare("INSERT INTO approved_comments (user_id, book_id, content) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $comment['user_id'], $comment['book_id'], $comment['content']);
            if ($stmt->execute()) {
                $stmt = $conn->prepare("DELETE FROM held_comments WHERE id = ?");
                $stmt->bind_param("i", $commentId);
                if ($stmt->execute()) {
                    echo 'Comment approved successfully';
                } else {
                    echo 'Failed to approve comment';
                }
            } else {
                echo 'Failed to approve comment';
            }
        } elseif (isset($_POST['rejectComment'])) {
            $stmt = $conn->prepare("DELETE FROM held_comments WHERE id = ?");
            $stmt->bind_param("i", $commentId);
            if ($stmt->execute()) {
                echo 'Comment rejected successfully';
            } else {
                echo 'Failed to reject comment';
            }
        }
    } else {
        echo 'Comment not found';
    }
} else {
    http_response_code(400);
    echo 'Bad request';
}
$conn->close();
?>
