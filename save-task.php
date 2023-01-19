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
    $user = $_POST['user'];
    $priority = $_POST['priority'];
    $statusId = $_POST['statusId'];

    // connect
    $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100','Rich100', '');

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

    ?>
</body>
</html>