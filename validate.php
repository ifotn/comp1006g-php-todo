<?php
// connect
require('includes/db.php');

// query for a user with this username
$username = $_POST['username'];
$password = $_POST['password'];

// if a user found, compare the hashed password
$sql = "SELECT * FROM users WHERE username = :username";
$cmd = $db->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
$cmd->execute();
$user = $cmd->fetch();

// if user found, store their identity in the session object for persistence
if (empty($user)) {
    $db = null;
    header('location:login.php?valid=false');
    exit();
}
else {
    // username found, now hash & check password
    if (!password_verify($password, $user['password'])) {
        $db = null;
        header('location:login.php?valid=false');
        exit();
    }
    else {
        // access the current session so we can write a session variable to it with the user's identity
        session_start();
        $_SESSION['user'] = $username;
        header('location:tasks.php');
        exit();
    }
}
?>