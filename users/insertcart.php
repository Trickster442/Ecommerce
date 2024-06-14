<?php
session_start();
if (isset($_SESSION['user'])){
if(isset($_POST['addCart'])){
    $product_name = $_POST['pname'];
    $product_price = $_POST['pprice'];
    $product_quantity = $_POST['product_quantity'];

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }

    $check_duplicate = array_column($_SESSION['cart'], 'product_name');
    if(in_array($product_name, $check_duplicate)){
        echo"
            <script>
            alert('Product already added');
            window.location.href = 'index.php';
            </script>
        ";
    }
    else{
        $_SESSION['cart'][] = array('product_name' => $product_name, 'product_price' => $product_price, 'product_quantity' => $product_quantity);
        header('location:viewCart.php');
        exit(); // add this to prevent the script from continuing to run after the redirect
    }
}


//delete product
if(isset($_POST['delete'])){
    foreach ($_SESSION['cart'] as $key => $value) {
        if($value['product_name'] === $_POST['item']){
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            header('location:viewCart.php');
        }
    }
}

//update product
if(isset($_POST['update'])){
    $product_name = $_POST['pname'];
    $product_price = $_POST['pprice'];
    $product_quantity = $_POST['product_quantity'];
    $item = $_POST['item'];

    foreach ($_SESSION['cart'] as $key => $value) {
        if($value['product_name'] === $item){
            $_SESSION['cart'][$key] = array(
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_quantity' => $product_quantity
            );
            header('Location: viewCart.php');
            exit(); // add this to prevent the script from continuing to run after the redirect
            }
    }
}
}

else{
    header('location:login/login.php');
}