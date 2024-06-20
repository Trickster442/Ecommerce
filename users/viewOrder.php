<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php
    include("header.php"); // Include your header file
    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center bg-light mb-5 rounded">
                <h1 class="text-danger font-weight-700">View Order Details</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <?php
        // Assuming $conn is your database connection object
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user_id'];
            // Example order_id; replace with actual value or retrieve dynamically
            $order_id = 1;

            // SQL query to fetch order details with product information
            $query = "SELECT o.cart_id, c.product_id, p.product_name, p.price, c.quantity 
                      FROM `orders` o 
                      INNER JOIN cart c ON o.cart_id = c.id 
                      INNER JOIN product p ON c.product_id = p.id
                      WHERE o.user_id = $user_id";
            $result = mysqli_query($conn, $query);

            // Display order data
            $grand_total = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $product_name = $row['product_name'];
                $product_price = $row['price'];
                $product_quantity = $row['quantity'];
                $total = $product_price * $product_quantity;
                $grand_total += $total;

                // Displaying the order items in a structured format
                echo "
                    <div class='card mb-3'>
                        <div class='card-body'>
                            <h5 class='card-title'>Product Name: {$product_name}</h5>
                            <p class='card-text'>Price: {$product_price}</p>
                            <p class='card-text'>Quantity: {$product_quantity}</p>
                            <p class='card-text'>Total: {$total}</p>
                        </div>
                    </div>
                ";
            }

            // Display total outside the loop
            echo "
                <div class='text-center'>
                    <h3>Total</h3>
                    <h1 class='bg-success text-black'>
                        " . number_format($grand_total, 2) . "
                    </h1>
                </div>
            ";
        } else {
            header('location:login/login.php'); // Redirect to login page if user is not logged in
        }
        mysqli_close($conn); // Close database connection
        ?>
    </div>
</body>
</html>
