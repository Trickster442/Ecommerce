<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home Page</title>
    <link rel="stylesheet" href="isAdmin.css">
    <!-- font awesome cdn -->
</head>
<?php
session_start();

if(!$_SESSION['users']){
header("location:form/login.php");
}
?>
<body>
    <nav>
        <div class="Logo">
            Logo
        </div>
        <ul class="navigation-link">
            <li><a href="#">Hello, <?php

            echo $_SESSION['users'];
            ?>
            </a></li>
            <li><a href="form/logout.php">Logout</a></li>
            <li><a href="#">User Panel</a></li>
        </ul>
    </nav>

    <div>
        <h2 class="dashboard">Dashboard</h2>
    </div>
    <div class="secondary-nav">
        <a href="product/products.php">Add Post</a>
    </div>
</body>
</html>