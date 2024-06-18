<?php
include('config.php');
session_start(); 

if (isset($_SESSION['user'])){
    $user_id = $_SESSION['user_id'];
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
            $total  = (double) $product_price * (double) $product_quantity;
            $query = "SELECT id FROM product WHERE `product_name` = '$product_name'";
            $result = mysqli_query($conn, $query);
            if($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['id']; // Assign the fetched category ID
    }       else {
        // Category not found, handle the error or provide a default category ID
        $product_cat = 1; // Default category ID (you can change this to your specific requirement)
    }
            $query = " INSERT INTO cart (user_id, product_id, total_price, `quantity`) VALUES ('$user_id', '$product_id', '$total', '$product_quantity')";
            mysqli_query($conn, $query);
            header('location:viewCart.php');
            exit(); // add this to prevent the script from continuing to run after the redirect
        }
    }

    //delete product
    if(isset($_POST['delete'])){
        $item = $_POST['item'];
        $product_id = $_POST['product_id'];
        foreach ($_SESSION['cart'] as $key => $value) {
            if($value['product_name'] === $item){
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                $query = "DELETE FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
                mysqli_query($conn, $query);
                header('location:viewCart.php');
            }
        }
    }
    

    //update product
    if(isset($_POST['update'])){
        echo "I am here";
        $product_name = $_POST['pname'];
        $product_price = $_POST['pprice'];
        $product_quantity = $_POST['product_quantity'];
        $product_id = $_POST['product_id'];
        echo $product_id;
        $item = $_POST['item'];

        foreach ($_SESSION['cart'] as $key => $value) {
            if($value['product_name'] === $item){
                $_SESSION['cart'][$key] = array(
                    'product_name' => $product_name,
                    'product_price' => $product_price,
                    'product_quantity' => $product_quantity
                );
                $query = "UPDATE cart SET quantity = '$product_quantity' WHERE user_id = '$user_id' AND product_id = '$product_id'";
                mysqli_query($conn, $query);
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
        $total = (double) $product_price * (double) $product_quantity;
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
}
else{
    header('location:login/login.php');
}

