<?php
// auth check - this page is now private
require('includes/auth.php');

// read the selected taskId from the url param using $_GET
$taskId = $_GET['taskId'];

// connect
require('includes/db.php');

// set up the SQL DELETE
$sql = "DELETE FROM tasks WHERE taskId = :taskId";
$cmd = $db->prepare($sql);
$cmd->bindParam(':taskId', $taskId, PDO::PARAM_INT);

// run the delete
$cmd->execute();

// disconnect
$db = null;

// show confirmation / redirect
echo '<p>Task Deleted</p>
    <a href="tasks.php">See the Updated Task List</a>';

header('location:tasks.php');
?>