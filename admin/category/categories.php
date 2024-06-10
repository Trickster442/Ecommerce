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
        <th>S.N</th>
        <th>Category Name</th>
        <th>Status</th>
        <th>Delete</th>
        <th>Update</th>
    </thead>
    <tbody>
    <?php
include '../product/config.php';

$record = mysqli_query($conn, "SELECT * FROM `category`");
$count = 1;
while ($row = mysqli_fetch_array($record)) {
    echo "
        <tr>
            <td>{$count}</td>
            <td>$row[category_name]</td>
            <td>$row[status]</td>
            <td>
                <div class='delete'>
                    <a href='delete.php?id=" . $row['id'] . "'>Delete</a>
                </div>
            </td>
            <td>
            <div class='update'>
                <a href='update.php?id=" . $row['id'] . "'>Update</a>
            </div>
            </td>
        </tr>
    ";
    $count++;
}
?>
    </tbody>
</table>

</body>
</html>