<?php
// get taskId from url param using $_GET
$taskId = $_GET['taskId'];

// connect
 $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', '');

// fetch the selected task record with this taskId.  use fetch() not fetchAll() for single row queries
$sql = "SELECT * FROM tasks WHERE taskId = :taskId";
$cmd = $db->prepare($sql);
$cmd->bindParam(':taskId', $taskId, PDO::PARAM_INT);
$cmd->execute();
$task = $cmd->fetch();

if (empty($task)) {
    header('location:404.php');
    exit();
}

// store the values in local vars
$name = $task['name'];
$user = $task['user'];
$priority = $task['priority'];
$statusId = $task['statusId'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <!-- remove any custom browser styles -->
    <link rel="stylesheet" href="css/normalize.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="css/app.css" />
</head>
<body>
    <header>
        <h1>
            <a href="#">PHP To-Do</a>
        </h1>
        <nav>
            <ul>
                <li>
                    <a href="tasks.php">Tasks</a>
                </li>
                <li>
                    <a href="#">Register</a>
                </li>
                <li>
                    <a href="#">Login</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Edit Task</h1>
        <form action="save-task.php" method="post">
            <fieldset>
                <label for="name">Name:</label>
                <textarea name="name" id="name" required><?php echo $name; ?></textarea>
            </fieldset>
            <fieldset>
                <label for="user">User:</label>
                <input name="user" id="user" required type="email" value="<?php echo $user; ?>" />
            </fieldset>
            <fieldset>
                <label for="priority">Priority:</label>
                <input name="priority" id="priority" type="number" required min="1" max="3" value="<?php echo $priority; ?>" />
            </fieldset>
            <fieldset>
                <label for="statusId">Status:</label>
                <select name="statusId" id="status">
                    <?php
                    // write query
                    $sql = "SELECT * FROM status";

                    // create the command
                    $cmd = $db->prepare($sql);

                    // run the query
                    $cmd->execute();

                    // store query results in a var
                    $status = $cmd->fetchAll();

                    // loop and display as <option></option>
                    foreach ($status as $value) {
                        // if task status matches the current status in the loop, select this option
                        if ($statusId == $value['statusId']) {
                            echo '<option selected value="' . $value['statusId'] .
                                '">' . $value['status'] . '</option>';
                        }
                        else {
                             echo '<option value="' . $value['statusId'] .
                                '">' . $value['status'] . '</option>';
                        }                        
                    }

                    // disconnect
                    $db = null;
                    ?>
                </select>
            </fieldset>
            <button class="btnOffset">Update</button>
        </form>
    </main>
</body>
</html>