<?php
if (isset($_SESSION['user_id'])) {
    $loggedIn = true;
  } else{
    $loggedIn = false;
  }
  
  if(isset($_POST['logout'])){
    $_SESSION = array();
  
    session_destroy();
  
    header("Location: index.php");
    exit;
  }
?>