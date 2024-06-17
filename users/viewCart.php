<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart-Page</title>
</head>

<?php
include("header.php");
?>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center bg-light mb-5 rounded">
                <h1 class="text-danger font-weight-700">My Cart</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-around">
            <div class="col-sm-12 col-md-6 col-lg-9">
                <table class="table table-bordered text-center ">
                    <thead class="bg-danger text-danger fs-5">
                        <th>S.N</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>Total Price</th>
                        <th>Update</th>
                        <th>Delete</th>
                        <th>Order</th>
                    </thead>
                    <tbody>
                    <?php
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user_id'];
        // Retrieve cart data for this user with product details
        $query = "SELECT c.product_id, p.product_name, p.price, c.quantity 
                  FROM cart c 
                  INNER JOIN product p ON c.product_id = p.id 
                  WHERE c.user_id = $user_id";
        $result = mysqli_query($conn, $query);

        // Display cart data
        $ttotal = 0; // Total variable initialization
        $i = 0; // Counter initialization
        while ($row = mysqli_fetch_assoc($result)) {
            $i++; // Increment counter
            $product_id = $row['product_id'];
            $product_name = $row['product_name'];
            $product_price = $row['price'];
            $product_quantity = $row['quantity'];
            $total = (double)$product_price * (double)$product_quantity;
            $ttotal += $total; // Accumulate total

            // Displaying the cart items in a form for update/delete
            echo "
                <form action='insertcart.php' method='POST'>
                    <tr>
                        <td>{$i}</td>
                        <td><input type='text' name='pname' value='{$product_name}' readonly></td>
                        <td><input type='text' name='pprice' value='{$product_price}' readonly></td>
                        <td><input type='text' name='product_quantity' value='{$product_quantity}'></td>
                        <td>$total</td>
                        <td><button name='update' class='btn btn-success'>Update</button></td>
                        <td><button name='delete' class='btn btn-danger'>Delete</button></td>
                        <td><input type='submit' name='addOrder' class='btn btn-success text-white  w-100' value = 'Order'></td>
                    </tr>
                    <input type='hidden' name='product_id' value='{$product_id}'>
                </form>
            ";
        }
    } else {
        header('location:login/login.php'); // Redirect to login page if user is not logged in
    }

    $conn->close();
?>

                 <!-- <?php
                        
                        $total = 0;
                        $ttotal = 0;
                        $i = 0;
                        if (isset($_SESSION['cart'])) {
                            
                            foreach ($_SESSION['cart'] as $key => $value) {
                                $total = (double) $value['product_price'] * (double)$value['product_quantity'] ;
                                $ttotal += $total; 
                                $i = $key+1;
                               echo" 
                               <form action = 'insertcart.php' method = 'POST'>
                               <tr>
                               <td>{$i}</td>
                               <td><input type='text' name = 'pname' value='$value[product_name]' readonly></td>
                               <td><input type='text' name = 'pprice' value='$value[product_price]' readonly></td>
                               <td><input type='text' name = 'product_quantity' value='$value[product_quantity]'></td>
                               <td>$total</td>
                               <td><button name='update' class='btn btn-warning'>Update</button></td>
                               <td><button name= 'delete' class='btn btn-danger'>Delete</button></td>
                               <td><input type='submit' name='addOrder' class='btn btn-success text-white  w-100' value = 'Order'></td>
                               <input type ='hidden' name='item' value = '$value[product_name]'> 
                                
                               </tr>
                            </form>
                                ";
                                
                        }
                    }
                        ?>-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="lg-3 text-center">
        <H3>Total</H3>
        <h1 class="bg-success text-black">
            <?php echo number_format($ttotal,2) ?>
        </h1>
    </div>
</body>
</html>