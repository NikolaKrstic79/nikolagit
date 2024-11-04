<?php 

$name = "Kathrin";

if ($name == "Kathrin") {
    echo "Hello Kathrin";
} else {
    echo "Nice name";
}
echo "<br>";
// RATING
$rating = 7;

if ($rating >= 1 && $rating <= 10) {
    echo "Thank you for rating";
} else {
    echo "Invalid rating, only numbers between 1 and 10";
}
echo "<br>";
// TIME CHECK
$timeHour = date('H');

if ($timeHour < 12) {
    echo "Good morning Kathrin";
} elseif ($timeHour >= 12 && $timeHour < 19) {
    echo "Good afternoon Kathrin";
} else {
    echo "Good evening Kathrin";
}
echo "<br>";
// VOTING CHECK
$rating = 7;
$rated = true;

if (is_int($rating) && $rating >= 1 && $rating <= 10) { 
    if ($rated) {
        echo "You already voted";
    } else {
        echo "Thanks for voting";
    }
} else {
    echo "Invalid rating, only numbers between 1 and 10";
}
echo "<br>";
// VOTING
$voters = array(
    "John" => array(false, 8),
    "Emily" => array(true, 6),
    "Michael" => array(true, 9),
    "Sophia" => array(false, 4),
    "William" => array(true, 7),
    "Olivia" => array(false, 90),
    "James" => array(true, 10),
    "Ava" => array(false, 5),
    "Benjamin" => array(true, 3),
    "Isabella" => array(false, 1)
);
foreach ($voters as $voterName => $voterData) {
    echo "<br>";
    echo "Good ";
    $currentTime = date("H:i:s");
    if ($currentTime >= "05:00:00" && $currentTime < "12:00:00") {
        echo "morning ";
    } elseif ($currentTime >= "12:00:00" && $currentTime < "18:00:00") {
        echo "afternoon ";
    } else {
        echo "evening ";
    }
    echo $voterName . "\n";
    $hasVoted = $voterData[0];
    $rating = $voterData[1];

    if ($hasVoted) {
        echo "Thanks for voting with a rating of $rating.\n";
    } else {
        if ($rating >= 1 && $rating <= 10) {
            echo "You already voted with a rating of $rating.\n";
        } else {
            echo "Invalid rating, only numbers between 1 and 10.\n";
        }
    }
}
?>