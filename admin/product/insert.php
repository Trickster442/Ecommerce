<?php
session_start();

if(!$_SESSION['users']){
header("location:../form/login.php");
}
?>

<?php
if(isset($_POST['submit'])) {
    include 'config.php';

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

    // Inserting product
    mysqli_query($conn, "INSERT INTO `product`(`product_name`, `price`, `product_image`, `stock`, `category_id`) VALUES ('$product_name','$product_price','$img_des','$product_stock', '$product_cat')");
}


