<?php
if(isset($_POST['submit'])){

        include 'config.php';

    $product_name = $_POST['pname'];
    $product_price = $_POST['pprice'];
    $product_stock = $_POST['pstock'];
    $product_image = $_FILES['pimage'];
    $image_loc = $_FILES['pimage']['tmp_name'];
    $image_name = $_FILES['pimage']['name'];
    $product_cat = $_POST['pcat'];
    $img_des = "uploadImage/".$image_name;
    move_uploaded_file($image_loc, "uploadImage/". $image_name );

    //inserting product
    mysqli_query( $conn," INSERT INTO `product`(`product_name`, `price`, `product_image`, `stock`) VALUES ('$product_name','$product_price','$img_des','$product_stock')");
}
