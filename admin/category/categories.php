<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="categories.css">
    <title>Category Page</title>
</head>
<?php
session_start();

if(!$_SESSION['users']){
header("location:../form/login.php");
}
?>
<body>
    <form action="catinsert.php" method="POST" enctype="multipart/form-data">
        <div class="top">
            <p>Category Details:</p>
        </div>
        <div class="category-name">
            <label for="cat-name">Category Name:</label>
            <input type="text" id="cat-name" name="catname" placeholder="Enter Category Name" required>
        </div>

        <div class="category-status">
                        <label for="status">Select Category Status:</label>
                        <select id="status" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive" selected>Inactive</option>
                        </select>
                    </div>
        <button name="submit" type="submit" class="upload">Upload</button>
    </form>
    <!-- fetch data -->
<div class="table-section">
<table>
    <thead>
        <th>ID</th>
        <th>Category Name</th>
        <th>Status</th>
        <th>Delete</th>
    </thead>
    <tbody>
    <?php
include '../product/config.php';

$record = mysqli_query($conn, "SELECT * FROM `category`");

while ($row = mysqli_fetch_array($record)) {
    echo "
        <tr>
            <td>$row[id]</td>
            <td>$row[category_name]</td>
            <td>$row[status]</td>
            <td></td>
        </tr>
    ";
}
?>
    </tbody>
</table>

</body>
</html>