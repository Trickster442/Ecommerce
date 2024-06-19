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
        echo "I am here";
        $id = $_POST['id'];
        $product_name = $_POST['pname'];
        $product_price = $_POST['pprice'];
        $product_quantity = $_POST['product_quantity'];
        $product_id = $_POST['product_id'];
        echo $product_id;
        $item = $_POST['item'];
        $sql = "DELETE FROM `cart` WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo"
            <script>
            alert('Deleted successfully');
            window.location.href='../viewCart.php';
            </script>
            ";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
            header("location:viewCart.php");
            exit;
    }
    

    //update product
    if(isset($_POST['update'])){
        echo "I am here";
        $id = $_POST['id'];
        $product_name = $_POST['pname'];
        $product_price = $_POST['pprice'];
        $product_quantity = $_POST['product_quantity'];
        $product_id = $_POST['product_id'];
        echo $product_id;
        $item = $_POST['item'];
            $update_query = " UPDATE `cart` SET `quantity`='$product_quantity' WHERE id = $id ";
            echo $update_query ; 
            if (!mysqli_query($conn, $update_query)) {
                echo "Error: ". mysqli_error($conn);
                exit;
            }
        
            header("location:viewCart.php");
            exit;
        }
    

    if(isset($_POST['addOrder'])){
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
            $query = " SELECT id FROM product WHERE `product_name` = '$product_name'";
            $result = mysqli_query($conn, $query);
            if($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['id']; // Assign the fetched category ID
    }       else {
        // Category not found, handle the error or provide a default category ID
        $product_cat = 1; // Default category ID (you can change this to your specific requirement)
    }
            $query = " INSERT INTO order (user_id, product_id, total_price) VALUES ('$user_id', '$product_id', '$total')";
            mysqli_query($conn, $query);
            header('location:viewOrder.php');
            exit(); // add this to prevent the script from continuing to run after the redirect
        }
    }
}
else{
    header('location:login/login.php');
}

