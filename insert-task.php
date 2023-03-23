<?php
// auth check - this page is now private
require('includes/auth.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saving Task Details...</title>
</head>
<body>
    <?php
    // capture form inputs to vars
    $name = $_POST['name'];
    $user = $_SESSION['user']; //$_POST['user'];
    $priority = $_POST['priority'];
    $statusId = $_POST['statusId'];
    $ok = true; // flag to assess overall completeness of form data

    // validation 1 field at a time
    if (empty($name)) {
        echo '<p>Name is required.</p>';
        $ok = false;
    }

    if (empty($user)) {
        echo '<p>User is required.</p>';
        $ok = false;
    }
    else if (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
        echo '<p>User must use a valid email format.</p>';
        $ok = false;
    }

    if (empty($priority)) {
        echo '<p>Priority is required.</p>';
        $ok = false;
    }
    else if (!is_numeric($priority)) {
        echo '<p>Priority must be numeric.</p>';
        $ok = false;
    }

    if (empty($statusId)) {
        echo '<p>Status is required.</p>';
        $ok = false;
    }
    else if (!is_numeric($statusId)) {
        echo '<p>Status must be numeric.</p>';
        $ok = false;
    }

    // only connect and save if $ok is still true (no validtion errors)
    if ($ok) {
        // connect
        require('includes/db.php');

        // set up sql insert w/params
        $sql = "INSERT INTO tasks (name, user, priority, statusId) 
            VALUES (:name, :user, :priority, :statusId)";

        // create pdo command & populate vars into params
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':name', $name, PDO::PARAM_STR, 255);
        $cmd->bindParam(':user', $user, PDO::PARAM_STR, 100);
        $cmd->bindParam(':priority', $priority, PDO::PARAM_INT);
        $cmd->bindParam(':statusId', $statusId, PDO::PARAM_INT);

        // run the insert
        $cmd->execute();

        // disconnect
        $db = null;

        // show confirmation
        echo "Task Saved";
    }
    ?>
</body>
</html>