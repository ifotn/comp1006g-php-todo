<?php
// auth check - this page is now private
require('includes/auth.php');

$title = 'Add a New Task';
require('includes/header.php');
?>
<main>
    <h1>Add a New Task</h1>
    <h5>* indicates Required fields</h5>
    <form action="insert-task.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <label for="name">Name: *</label>
            <textarea name="name" id="name" required></textarea>
        </fieldset>
        <!--<fieldset>
            <label for="user">User:</label>
            <input name="user" id="user" required type="email" />
        </fieldset>-->
        <fieldset>
            <label for="priority">Priority: *</label>
            <input name="priority" id="priority" type="number" required min="1" max="3" />
        </fieldset>
        <fieldset>
            <label for="statusId">Status: *</label>
            <select name="statusId" id="status">
                <?php
                // connect
                require('includes/db.php');

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
                        '">' . $value['status'] . '</option>';
                }

                // disconnect
                $db = null;
                ?>
            </select>
        </fieldset>
        <fieldset>
            <label for="photo">Photo:</label>
            <input type="file" name="photo" id="photo" />
        </fieldset>
        <button class="btnOffset">Save</button>
    </form>
</main>
<?php require('includes/footer.php'); ?>