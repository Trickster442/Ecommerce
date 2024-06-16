<?php
session_start();
if (isset($_SESSION['user'])) {
    // Add to cart
    if (isset($_POST['addCart'])) {
        $product_name = $_POST['pname'];
        $product_price = $_POST['pprice'];
        $product_quantity = $_POST['product_quantity'];

        $query = "SELECT * FROM cart WHERE user_id = $user_id AND product_name = '$product_name'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "
                <script>
                alert('Product already added');
                window.location.href = 'index.php';
                </script>
            ";
        } else {
            $query = "INSERT INTO cart (user_id, product_name, product_price, product_quantity) VALUES ($user_id, '$product_name', $product_price, $product_quantity)";
            mysqli_query($conn, $query);

            header('location:viewCart.php');
            exit(); // Exit after redirect to prevent further script execution
        }
    }

    // Delete product from cart
    if (isset($_POST['delete'])) {
        $cart_id = $_POST['cart_id'];

        $query = "DELETE FROM cart WHERE cart_id = $cart_id AND user_id = $user_id";
        mysqli_query($conn, $query);

        header('location:viewCart.php');
        exit(); // Exit after redirect to prevent further script execution
    }

    // Update product in cart
    if (isset($_POST['update'])) {
        $cart_id = $_POST['cart_id'];
        $product_quantity = $_POST['product_quantity'];

        $query = "UPDATE cart SET product_quantity = $product_quantity WHERE cart_id = $cart_id AND user_id = $user_id";
        mysqli_query($conn, $query);

        header('location:viewCart.php');
        exit(); // Exit after redirect to prevent further script execution
    }
} else {
    header('location:../login/login.php'); // Redirect to login page if user is not logged in
}
