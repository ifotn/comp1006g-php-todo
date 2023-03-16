<?php
// code-only file so no HTML template needed

// grab form inputs
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

// validate
if (empty($username)) {
    echo 'Username required.<br />';
    $ok = false;
}

if (empty($password)) {
    echo 'Password required.<br />';
    $ok = false;
}

if ($password != $confirm) {
    echo 'Passwords do not match.<br />';
    $ok = false;
}

if ($ok) {
    // connect
    require('includes/db.php');

    // hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // set up and run the insert using bindParam()
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
    $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
    $cmd->execute();

    // disconnect
    $db = null;

    // redirect

}
?>