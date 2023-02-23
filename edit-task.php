<?php
$title = 'Task Details';
require('includes/header.php');

// get taskId from url param using $_GET
$taskId = $_GET['taskId'];

if (empty($taskId) || !is_numeric($taskId)) {
    header('location:400.php');  // bad request http 400 error
    exit();
}

// connect
require('includes/db.php');

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
<main>
    <h1>Edit Task</h1>
    <form action="update-task.php" method="post">
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
                    } else {
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
        <input name="taskId" id="taskId" value="<?php echo $taskId; ?>" type="hidden" />
    </form>
</main>
<?php require('includes/footer.php'); ?>