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
            <textarea name="name" id="name"></textarea>
        </fieldset>
        <fieldset>
            <label for="user">User:</label>
            <input name="user" id="user" />
        </fieldset>
        <fieldset>
            <label for="priority">Priority:</label>
            <input name="priority" id="priority" type="number" />
        </fieldset>
        <fieldset>
            <label for="statusId">Status:</label>
            <select name="statusId" id="status">
                <option value="1">To Do</option>
                <option value="2">Doing</option>
                <option value="3">Done</option>
            </select>
        </fieldset>
        <button>Save</button>
    </form>
</body>
</html>