<?php 
$title = 'Task List'; // set var used for <title> element in header
require('includes/header.php'); 
?>
<main>
    <h1>Task List</h1>
    <?php
    if (!empty($_SESSION['user'])) {
        echo '<a href="add-task.php">Add a New Task</a>';
    
        try {
            // 1. Connect to the db. Host: 172.31.22.43, DB: dbNameHere, Username: usernameHere, PW: passwordHere
            require('includes/db.php');

            // 2. Write the SQL Query to read all the records from the tasks table and store in a variable
            $sql = "SELECT * FROM tasks 
                INNER JOIN status ON tasks.statusId = status.statusId 
                WHERE user = :user";

            // 3. Create a Command variable $cmd then use it to run the SQL Query
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':user', $_SESSION['user'], PDO::PARAM_STR, 50);

            // 3a. Run the query
            $cmd->execute();

            // 4. Use the fetchAll() method of the PDO Command variable to store the data into a variable called $tasks. fetchAll() returns a 2D array (rows and columns)
            $tasks = $cmd->fetchAll();

            // start html table format
            echo '<table class="sortable"><thead><th>Name</th><th>User</th>
                <th>Priority</th><th>Status</th>';
            if (!empty($_SESSION['user'])) {
                echo '<th>Actions</th>';
            }
            echo '</thead>';

            // 5. Use a foreach loop to iterate (cycle) through all the values in the $tasks variable. Inside this loop, use an echo command to display the name of each task. See https://www.php.net/manual/en/control-structures.foreach.php for details.
            foreach ($tasks as $task) {
                // //<a href="delete-task.php" class="linkButton">
                //    Delete
                echo '<tr>
                        <td>' . $task['name'] . '</td>';

                if (!empty($_SESSION['user'])) {
                    echo '<td>' . $task['user'] . '</td>
                        <td>' . $task['priority'] . '</td>
                        <td>' . $task['status'] . '</td>
                        <td class="centre">
                            <a href="edit-task.php?taskId=' . base64_encode($task['taskId']) . '" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i></a> <a href="delete-task.php?taskId=' . $task['taskId'] . '"
                                title="Delete" onclick="return confirmDelete();">
                                    <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>';
                }
                echo '</tr>';
            }

            echo '</table>';

            // 6. Disconnect from the database
            $db = null;
        }
        catch (Exception $e) {
            header('location:error.php');
            exit();
        }
    }
    else {
        echo '<p>Glad you found us!  Please Register then 
            Login to start tracking your tasks for free!';
    }
    ?>
</main>
<?php require('includes/footer.php'); ?>