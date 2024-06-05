<?php
session_start();
if (!$_SESSION["users"]) {
    header("location:../form/login.php");
    exit;
}
?>

<?php
include 'config.php';
?>
<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $product_name = $_POST['pname'];
    $product_price = $_POST['pprice'];
    $product_stock = $_POST['pstock'];
    $product_image = $_FILES['pimage'];
    $image_loc = $_FILES['pimage']['tmp_name'];
    $image_name = $_FILES['pimage']['name'];
    $product_cat_name = $_POST['pcat'];

    // Get the category ID corresponding to the selected category name
    $query = "SELECT id FROM category WHERE category_name = '$product_cat_name'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "Error: ". mysqli_error($conn);
        exit;
    }
    if ($row = mysqli_fetch_assoc($result)) {
        $product_cat = $row['id'];
        echo $product_cat;
    } else {
        // Category not found, handle the error or provide a default category ID
        $product_cat = 1; // Default category ID (you can change this to your specific requirement)
    }

    // Upload image and insert product
    $img_des = "uploadImage/". $image_name;
    if (!move_uploaded_file($image_loc, "uploadImage/". $image_name)) {
        echo "Error: Unable to upload image";
        exit;
    }

    $update_query = " UPDATE `product` SET `product_name`='$product_name',`price`='$product_price',`stock`='$product_stock',`category_id`='$product_cat',`product_image`='$img_des' WHERE id = $id ";
    echo $update_query ;
    if (!mysqli_query($conn, $update_query)) {
        echo "Error: ". mysqli_error($conn);
        exit;
    }

    header("location:products.php");
    exit;
}
?>
<?php
if (isset($_GET['id'])) {
    $id = (int) $_GET['id']; // cast to integer to prevent SQL injection
    $sql = "SELECT * FROM `product` WHERE id = $id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc(); // Fetch the product data
    } else {
        echo "Record not found";
        exit; // Add exit to prevent further execution
    }
} else {
    echo "ID parameter missing";
    exit; // Add exit to prevent further execution
    
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="update.css">
    <title>Product Page</title>
</head>

<body>
<form action="update.php" method="POST" enctype="multipart/form-data">
    <div class="top">
        <p>Product Update Details:</p>
    </div>
    <div class="product-name">
        <label for="pname">Product Name:</label>
        <input type="text" id="pname" value="<?php echo $product['product_name']?>" name="pname" placeholder="Enter Product Name" required>
    </div>

    <div class="product-price">
        <label for="pprice">Product Price:</label>
        <input type="text" id="pprice" value="<?php echo $product['price']?>" name="pprice" placeholder="Enter Product Price" required>
    </div>

    <div class="product-image">
        <label for="pimage">Add Product Image:</label>
        <input type="file" id="pimage" name="pimage" required>
        <img src="<?php echo $product['product_image']?>" alt="..." style="height : 100px; width : 100px; ">
    </div>

    <div class="product-stock">
        <label for="pstock">Product Stock:</label>
        <input type="text" id="pstock" value="<?php echo $product['stock']?>" name="pstock" placeholder="Enter Stock Amount">
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

    <input type="hidden" name="id" value="<?php echo $id?>">

    <button name="update" type="submit" class="upload">Update</button>
</form>

</body>
</html>