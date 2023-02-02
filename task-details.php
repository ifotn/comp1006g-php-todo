<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
</head>
<body>
    <form action="save-task.php" method="post">
        <fieldset>
            <label for="name">Name:</label>
            <textarea name="name" id="name" required></textarea>
        </fieldset>
        <fieldset>
            <label for="user">User:</label>
            <input name="user" id="user" required type="email" />
        </fieldset>
        <fieldset>
            <label for="priority">Priority:</label>
            <input name="priority" id="priority" type="number" required min="1" max="3" />
        </fieldset>
        <fieldset>
            <label for="statusId">Status:</label>
            <select name="statusId" id="status">
                <?php
                // connect
                $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', '');

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
                    echo '<option value="' . $value['statusId'] . 
                        '">'. $value['status'] . '</option>';
                }

                // disconnect
                $db = null;
                ?>
            </select>
        </fieldset>
        <button>Save</button>
    </form>
</body>
</html>