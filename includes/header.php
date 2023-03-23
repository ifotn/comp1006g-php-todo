<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
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
                <?php
                // access the current session
                if (session_status() == PHP_SESSION_NONE) {
                    session_start(); 
                }
                
                if (empty($_SESSION['user'])) {
                ?>
                    <li>
                        <a href="register.php">Register</a>
                    </li>
                    <li>
                        <a href="login.php">Login</a>
                    </li>
                <?php
                }
                else {
                ?>
                    <li>
                        <a href="#"><?php echo $_SESSION['user'] ?></a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </header>