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
    <script src="js/sorttable.js" defer></script>
    
</head>
<body>
    <main>
        <h1>Task List</h1>
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
        echo '<table class="sortable"><thead><th>Name</th><th>User</th><th>Priority</th><th>Status</th></thead>';

        // 5. Use a foreach loop to iterate (cycle) through all the values in the $tasks variable. Inside this loop, use an echo command to display the name of each task. See https://www.php.net/manual/en/control-structures.foreach.php for details.
        foreach ($tasks as $task) {
            echo '<tr>
                <td>' . $task['name'] . '</td>
                <td>' . $task['user'] . '</td>
                <td>' . $task['priority'] . '</td>
                <td>' . $task['status'] . '</td>
                </tr>';
        }

        echo '</table>';

        // 6. Disconnect from the database
        $db = null;
        ?>
    </main>
</body>
</html>