<?php
session_start();
    $product_name = $_POST['pname'];
    $product_price = $_POST['pprice'];
    $product_quantity = $_POST['product_quantity'];

if(isset($_POST['addCart'])){

    $check_duplicate = array_column($_SESSION['cart'], 'product_name');
    if(in_array($product_name, $check_duplicate)){
        echo"
            <script>
            alert('product already added');
            window.location.href = 'index.php';
            </script>
        ";
    }
    else{
        $_SESSION['cart'][] = array('product_name' => $product_name, 'product_price' => $product_price, 'product_quantity' => $product_quantity);
        header('location:viewCart.php');
    }
}
