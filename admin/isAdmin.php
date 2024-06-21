<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home Page</title>
    <link rel="stylesheet" href="isAdmin.css">
    <?php
    include('header.php');

?>
</head>
<?php

if(!$_SESSION['users']){
header("location:form/login.php");
}


?>
<body>

    <div>
        <h2 class="dashboard">Dashboard</h2>
    </div>
    <div class="secondary-nav">
        <a href="./product/products.php">Add Post</a>
        <a href="category/categories.php">Add Category</a>
    </div>
</body>
</html>