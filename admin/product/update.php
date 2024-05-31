<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="update.css">
    <title>Product Page</title>
</head>
<?php
session_start();

if (!$_SESSION["users"]) {
    header("location:../form/login.php");
}
?>

<body>
<?php
    $id = $_POST['id'];
    include('config.php');
    $record = mysqli_query($conn, " SELECT * FROM `product` WHERE id= $id ");
    $data = mysqli_fetch_array($record)
?>


    <form action="update.php" method="POST" enctype="multipart/form-data">
        <div class="top">
            <p>Product Update Details:</p>
        </div>
        <div class="product-name">
            <label for="pname">Product Name:</label>
            <input type="text" id="pname" value="<?php echo $data['product_name']?>" name="pname" placeholder="Enter Product Name" required>
        </div>
        </div>

        <div class="product-price">
            <label for="pprice">Product Price:</label>
            <input type="text" id="pprice" value=" <?php echo $data['price']?>"name="pprice" placeholder="Enter Product Price" required>
        </div>
        </div>

        <div class="product-image">
            <label for="pimage">Add Product Image:</label>
            <input type="file" id="pimage" name="pimage" required>
            <img src="<?php echo $data['product_image']?>" alt="..." style="height : 100px; width : 100px; ">
        </div>
        </div>

        <div class="product-stock">
            <label for="pstock">Product Stock:</label>
            <input type="text" id="pstock" value=" <?php echo $data['stock']?>"name="pstock" placeholder="Enter Stock Amount">
        </div>
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
<input type="hidden" name="id" value="<?php echo $data['id']?> " >
        <button name="update" type="submit" class="upload">Update</button>
    </form>
</body>
        <?php
    if(isset($_POST['update'])){

    $product_name = $_POST['pname'];
    $product_price = $_POST['pprice'];
    $product_stock = $_POST['pstock'];
    $product_image = $_FILES['pimage'];
    $image_loc = $_FILES['pimage']['tmp_name'];
    $image_name = $_FILES['pimage']['name'];
    $product_cat_name = $_POST['pcat']; // Assuming the category name is submitted from the form

    // Get the category ID corresponding to the selected category name
    $query = "SELECT id FROM category WHERE category_name = '$product_cat_name'";
    $result = mysqli_query($conn, $query);
    if($row = mysqli_fetch_assoc($result)) {
        $product_cat = $row['id']; // Assign the fetched category ID
    } else {
        // Category not found, handle the error or provide a default category ID
        $product_cat = 1; // Default category ID (you can change this to your specific requirement)
    }

    // Upload image and insert product
    $img_des = "uploadImage/".$image_name;
    move_uploaded_file($image_loc, "uploadImage/". $image_name );
    include('config.php');
    mysqli_query($conn , " UPDATE `product` SET `product_name`='$product_name',`price`='$product_price',`stock`='$product_stock',`category_id`='$product_cat_name',`product_image`='$img_des' WHERE id = $id");
    header("location:index.php");
    }

?>
</html>
