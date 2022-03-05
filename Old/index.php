<?php session_start();
    if ($_SERVER['REQUEST_URI'] == "/") {
      include('login.php');
    } elseif(isset($_GET['reg'])) {
      include("register.php");
    } else {
      include("resources/404.php");
    }
?>
