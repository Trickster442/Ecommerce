<?php
session_start();

if(!$_SESSION['users']){
header("location:../form/login.php");
}
?>
<?php
if(isset($_POST['submit'])) {
    include '../product/config.php';

    $category_name = $_POST['catname'];
    $status = $_POST['status'];// Assuming the category name is submitted from the form

    // Inserting category
    mysqli_query($conn, "INSERT INTO `category`(`category_name`, `status`) VALUES ('$category_name','$status')");
}


