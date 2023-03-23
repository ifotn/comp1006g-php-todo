<?php
// access the current session
session_start();

// remove all session vars
session_unset();

// kill the session
session_destroy();

header('location:login.php');
?>