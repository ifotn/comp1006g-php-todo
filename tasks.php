<?php 
$title = 'Task List'; // set var used for <title> element in header
require('includes/header.php'); 
?>
<main>
    <h1>Task List</h1>
    <a href="add-task.php">Add a New Task</a>
    <?php
    try {
        // 1. Connect to the db. Host: 172.31.22.43, DB: dbNameHere, Username: usernameHere, PW: passwordHere
        require('includes/db.php');

        // 2. Write the SQL Query to read all the records from the tasks table and store in a variable
        $sql = "SELECT * FROM tasks INNER JOIN status ON tasks.statusId = status.statusId";

        // 3. Create a Command variable $cmd then use it to run the SQL Query
        $cmd = $db->prepare($sql);

        // 3a. Run the query
        $cmd->execute();

        // 4. Use the fetchAll() method of the PDO Command variable to store the data into a variable called $tasks. fetchAll() returns a 2D array (rows and columns)
        $tasks = $cmd->fetchAll();

        // start html table format
        echo '<table class="sortable"><thead><th>Name</th><th>User</th><th>Priority</th><th>Status</th><th>Actions</th>
                </thead>';

        // 5. Use a foreach loop to iterate (cycle) through all the values in the $tasks variable. Inside this loop, use an echo command to display the name of each task. See https://www.php.net/manual/en/control-structures.foreach.php for details.
        foreach ($tasks as $task) {
            // //<a href="delete-task.php" class="linkButton">
            //    Delete
            echo '<tr>
                    <td>' . $task['name'] . '</td>
                    <td>' . $task['user'] . '</td>
                    <td>' . $task['priority'] . '</td>
                    <td>' . $task['status'] . '</td>
                    <td class="centre">
                        <a href="edit-task.php?taskId=' . $task['taskId'] . '" title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>           
                        <a href="delete-task.php?taskId=' . $task['taskId'] . '"
                            title="Delete" onclick="return confirmDelete();">
                                <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                    </tr>';
        }

        echo '</table>';

        // 6. Disconnect from the database
        $db = null;
    }
    catch (Exception $e) {
        header('location:error.php');
        exit();
    }
    ?>
</main>
<?php require('includes/footer.php'); ?>