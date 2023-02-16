<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <!-- remove any custom browser styles -->
    <link rel="stylesheet" href="css/normalize.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="css/app.css" />
    <!-- https://www.kryogenix.org/code/browser/sorttable/ for column sorting -->
    <!-- fontawesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/sorttable.js" defer></script>
    <script src="js/scripts.js" defer></script>
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
        <h1>Task List</h1>
        <a href="task-details.php">Add a New Task</a>
        <?php
        // 1. Connect to the db. Host: 172.31.22.43, DB: dbNameHere, Username: usernameHere, PW: passwordHere
        $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', '');

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
                    <a href="edit-task.php?taskId=' . $task['taskId'] .'" title="Edit">
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
        ?>
    </main>
</body>

</html>