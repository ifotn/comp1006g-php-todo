<?php
$title = 'Register';
require 'includes/header.php';
?>
<main>
    <h1>User Registration</h1>
    <h5>Passwords must be a minimum of 8 characters, 
        including 1 digit, 1 upper-case letter, and 1 lower-case letter.
    </h5>
    <form method="post" action="save-registration.php">
        <fieldset>
            <label for="username">Username: *</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com" />
        </fieldset>
        <fieldset>
            <label for="password">Password: *</label>
            <input type="password" name="password" id="password" required
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
        </fieldset>
        <fieldset>
            <label for="confirm">Confirm Password: *</label>
            <input type="password" name="confirm" id="confirm" required
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
        </fieldset>
        <button class="btnOffset">Register</button>
    </form>
</main>
<?php require('includes/footer.php');