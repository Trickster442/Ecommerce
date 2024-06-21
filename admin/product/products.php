<!-- index.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="products.css">
    <title>Product Page</title>
    <?php
    include('header.php');
    ?>
</head>

<?php

if (!$_SESSION["users"]) {
    header("location:../form/login.php");
}
?>

<body>
    <div class="clearfix">
        <form action="insert.php" method="POST" enctype="multipart/form-data">
            <div class="top">
                <p>Product Details:</p>
            </div>
            <div class="product-name">
                <label for="pname">Product Name:</label>
                <input type="text" id="pname" name="pname" placeholder="Enter Product Name" required>
            </div>

            <div class="product-price">
                <label for="pprice">Product Price:</label>
                <input type="text" id="pprice" name="pprice" placeholder="Enter Product Price" required>
            </div>

            <div class="product-image">
                <label for="pimage">Add Product Image:</label>
                <input type="file" id="pimage" name="pimage" required>
            </div>

            <div class="product-stock">
                <label for="pstock">Product Stock:</label>
                <input type="text" id="pstock" name="pstock" placeholder="Enter Stock Amount">
            </div>

            <div class="product-category">
                <label for="pcat">Select Product Category:</label>
                <select id="pcat" name="pcat" required>
                    <option selected>Select Category</option>
                    <?php
                    include "config.php";
                    $sql = "SELECT * FROM `category` WHERE status = 'active'";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['category_name']}'>{$row['category_name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <button name="submit" type="submit" class="upload">Upload</button>
        </form>

        <div class="table-section">
            <table>
                <thead>
                    <th>S.N.</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Stock</th>
                    <th>Category</th>
                    <th>Delete</th>
                    <th>Update</th>
                </thead>
                <tbody>
                    <?php
                    include 'config.php';

                    $record = mysqli_query($conn, "SELECT p.*, c.category_name 
                                   FROM product p
                                   INNER JOIN category c ON p.category_id = c.id");
                    $count = 1;
                    while ($row = mysqli_fetch_array($record)) {
                        echo "
            <tr>
                <td>{$count}</td>
                <td>$row[product_name]</td>
                <td>$row[price]</td>
                <td><img src='$row[product_image]' height='50px' width='50px'></td>
                <td>$row[stock]</td>
                <td>$row[category_name]</td>
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
                        $count += 1;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>