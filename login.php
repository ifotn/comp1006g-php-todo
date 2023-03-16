<?php
$title = 'Login';
require 'includes/header.php';
?>
<main>
    <h1>Login</h1>
    <?php 
    if (!empty($_GET['valid'])) {
        echo '<h5 class="error">Invalid Login</h5>';
    }
    else {
        echo '<h5>Please enter your credentials.</h5>';
    }
    ?>        
    <form method="post" action="validate.php">
        <fieldset>
            <label for="username">Username:</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com" />
        </fieldset>
        <fieldset>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required />
        </fieldset>
        <button class="btnOffset">Login</button>
    </form>
</main>
<?php require('includes/footer.php'); ?>