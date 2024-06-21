<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
    <title>Header</title>
</head>
<body>
<nav>
<?php
session_start();

if(!$_SESSION['users']){
header("location:../form/login.php");
}
?>
        <div class="Logo">
            <a href="../isAdmin.php">Logo</a>
        </div>
        <ul class="navigation-link">
            <li><a href="#">Hello, <?php

            echo $_SESSION['users'];
            ?>
            </a></li>
            <li><a href="../form/logout.php">Logout</a></li>
        </ul>
    </nav>
</body>
</html>