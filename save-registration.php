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

// recaptcha - call google api and check success / failure response
$apiUrl = 'https://www.google.com/recaptcha/api/siteverify';
$secret = '6Leq_mQlAAAAADbsaefXW96BOHjJ-wPTH3iAesCo';
$response = $_POST['g-recaptcha-response'];

// make the api call and parse the results
$apiResponse = file_get_contents($apiUrl . '?secret=' . $secret . '&response=' . $response);
$decodedResponse = json_decode($apiResponse);

if ($decodedResponse->success == false) {
    echo 'Are you human??';
    $ok = false;
}

//print_r($apiResponse);
//exit();


if ($ok) {
    // connect
    require('includes/db.php');

    // does username already exist?
    $sql = "SELECT * FROM users WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
    $cmd->execute();
    $user = $cmd->fetch();
    if (empty($user)) {
        // hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // set up and run the insert using bindParam()
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
        $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
        $cmd->execute();
    }
    else {
        echo 'User already exists.<br />';
        exit();
    }        

    // disconnect
    $db = null;

    // redirect
    header('location:tasks.php');
}
?>