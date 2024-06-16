<?php
include('config.php');
session_start();
if (isset($_SESSION['user'])){
    // $user_id = $_SESSION['user_id'];
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
            // $query = "INSERT INTO cart (user_id, product_name, product_price, product_quantity) VALUES ('$user_id', '$product_name', '$product_price', '$product_quantity')";
            // mysqli_query($conn, $query);
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
                // $query = "DELETE FROM cart WHERE user_id = '$user_id' AND product_name = '".$_POST['item']."'";
                // mysqli_query($conn, $query);
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
                // $query = "UPDATE cart SET product_quantity = '$product_quantity' WHERE user_id = '$user_id' AND product_name = '".$_POST['item']."'";
                // mysqli_query($conn, $query);
                header('Location: viewCart.php');
                exit(); // add this to prevent the script from continuing to run after the redirect
            }
        }
    }

    if(isset($_POST['addOrder'])){
        $product_name = $_POST['pname'];
        $product_price = $_POST['pprice'];
        $product_quantity = $_POST['product_quantity'];
        $item = $_POST['item'];
        $total = $product_price * $product_quantity;
        foreach ($_SESSION['cart'] as $key => $value) {
            if($value['product_name'] === $item){
                $_SESSION['cart'][$key] = array(
                    'product_name' => $product_name,
                    'product_price' => $product_price,
                    'product_quantity' => $product_quantity
                );
                //insert the data into order table.
                //mysqli_query($conn, "INSERT INTO `orders`(`product_id`, `order_date`, `total_amount`) VALUES ('[value-5]','[value-6]','[value-7]')")
        }
    
    }
}

else{
    header('location:login/login.php');
}


}