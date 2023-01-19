<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saving Status...</title>
</head>
<body>
    <?php
    // read the form input using the $_POST array
    $status = $_POST['status'];

    // display the form input
    //echo $status;

    // connect to db
    $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100','Rich100', 'x');

    if (!$db) {
        echo 'Failed!';
    }
    else {
        echo 'Connected';
    }

    // set up the SQL INSERT
    $sql = "INSERT INTO status (status) VALUES (:status)";

    // populate the input params with vars
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':status', $status, PDO::PARAM_STR, 25);

    // execute the command
    $cmd->execute();

    // disconnect
    $db = null;

    // show confirmation
    echo 'Status Saved';

    ?>
</body>
</html>