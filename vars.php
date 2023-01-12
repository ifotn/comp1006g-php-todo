<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // php uses . to concatenate strings NOT +
    $year = 2023;
    echo '<p>' . $year . '</p>';
    echo '<p>$year</p>';

    // change to a string
    $year = "It is now";
    echo "<p class=\"someClass\">$year</p>";
    ?>
</body>
</html>