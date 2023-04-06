<?php
require('../includes/db.php');

$sql = "SELECT * FROM tasks";

if (!empty($_GET['user'])) {
    $sql .= " WHERE user = :user";
}

$cmd = $db->prepare($sql);
if (!empty($_GET['user'])) {
    $cmd->bindParam(':user', $_GET['user'], PDO::PARAM_STR, 100);
}
$cmd->execute();
$tasks = $cmd->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($tasks);
$db = null;
?>