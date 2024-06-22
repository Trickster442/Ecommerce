<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>PC-Page</title>
    <?php
    include('header.php');

?>
</head>
<body>
<div class="container-fluid">
    <div class="colmd-12">

    
<div class="row">


    <H1 class="text-black font-monospace text-center my-3 fw-bold">PC</H1>
<?php
include('config.php');

$record = mysqli_query($conn, "SELECT p.*, c.category_name 
                               FROM product p
                               INNER JOIN category c ON p.category_id = c.id
                               ");

 while($row = mysqli_fetch_array($record)){

    $check_page = $row['category_name'];
    if ($check_page === 'PC'){

    echo "
    <div class='col-md-6 col-lg-4 m-auto mb-3 '>
    <form action = 'insertcart.php' method = 'POST'>
    <div class='card m-auto' style='width: 18rem;'>
  <img src='../admin/product/$row[product_image]' class='card-img-top' alt='...' style='max-width: 100%; height: 180px; object-fit: cover;'>
  <div class='card-body text-center '>
    <h5 class='card-title text-center fs-4 fw-bold'>$row[product_name]</h5>
    <p class='card-text text-center fs-4 fw-bold'>RS: $row[price]</p>
    <input type = 'hidden' name='pname' value='$row[product_name]'>
    <input type='hidden' name='pprice' value='$row[price]'>
    <input type='number' name= 'product_quantity' value= 'min='1' max = '20'' placeholder='Quantity'><br><br>
    <input type='submit' name='addCart' class='btn btn-danger text-white  w-100' value = 'Add To Cart'>
  </div>
</div>
</form>
</div>" ;
 }

}
 ?>

</div>
</div>
</div>
<?php
include('footer.php');
?>
</body>
</html>