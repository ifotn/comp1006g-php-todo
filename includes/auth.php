<?php
// access current session
session_start(); 

if (empty($_SESSION['user'])) {
    header('location:login.php');
    exit();
}
?>