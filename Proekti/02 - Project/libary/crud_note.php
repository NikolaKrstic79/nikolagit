<?php
session_start();

include "db.php";
include "userhandler.php";

if(!$loggedIn){
    http_response_code(403);
    echo 'You must be logged in to add or delete a note';
    exit();
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['noteContent'])) {
        $bookId = $_POST['bookId'];
        $noteContent = $_POST['noteContent'];

        $stmt = $conn->prepare("INSERT INTO notes (note_book_id, note_user_id, note_content, note_created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iis", $bookId, $_SESSION['user_id'], $noteContent);
        if ($stmt->execute()) {
            $updatedNotes = fetchNotes($conn, $bookId);
            echo $updatedNotes;
        } else {
            echo 'Failed to add note';
        }
        $stmt->close();
    } elseif (isset($_POST['deleteNote'])) {
        $noteId = $_POST['noteId'];
        $stmt = $conn->prepare("DELETE FROM notes WHERE note_id = ? AND note_user_id = ?");
        $stmt->bind_param("ii", $noteId, $_SESSION['user_id']);
        if ($stmt->execute()) {
            echo 'Note deleted successfully';
        } else {
            echo 'Failed to delete note';
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

function fetchNotes($conn, $bookId) {
    $output = '';
    $stmt = $conn->prepare("SELECT * FROM notes WHERE note_book_id = ?");
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $output .= '<ul>';
        while ($note = $result->fetch_assoc()) {
            $output .= '<li>' . $note['note_content'] . '</li>';
        }
        $output .= '</ul>';
    } else {
        $output = '<p>No notes added for this book yet.</p>';
    }
    return $output;
}
?>
