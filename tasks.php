
<?php
// 1. Connect to the db. Host: 172.31.22.43, DB: dbNameHere, Username: usernameHere, PW: passwordHere
$db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', 'x');

// 2. Write the SQL Query to read all the records from the tasks table and store in a variable
$sql = "SELECT * FROM tasks";

// 3. Create a Command variable $cmd then use it to run the SQL Query
$cmd = $db->prepare($sql);

// 3a. Run the query
$cmd->execute();

// 4. Use the fetchAll() method of the PDO Command variable to store the data into a variable called $tasks. fetchAll() returns a 2D array (rows and columns)
$tasks = $cmd->fetchAll();

// 5. Use a foreach loop to iterate (cycle) through all the values in the $tasks variable. Inside this loop, use an echo command to display the name of each task. See https://www.php.net/manual/en/control-structures.foreach.php for details.
foreach ($tasks as $task) {
    echo $task['name'];
}

// 6. Disconnect from the database
$db = null;
?>
