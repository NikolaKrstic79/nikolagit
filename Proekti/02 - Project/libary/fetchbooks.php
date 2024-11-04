<?php
include "./db.php";

$slctBooks = "SELECT * FROM books";
$result = $conn->query($slctBooks);

$booksArr = array();
if($result -> num_rows > 0){
    while($row = $result -> fetch_assoc()){
        $booksArr[] = $row;
    }
}
?>