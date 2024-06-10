<?php
session_start();
if (!$_SESSION["users"]) {
    header("location:../form/login.php");
    exit;
}
?>

<?php
include 'config.php';
?>
<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $category_name = $_POST['cname'];
    $status = $_POST['status'];
    
    $update_query = " UPDATE `category` SET `category_name`='$category_name', `status` = '$status' WHERE id = $id ";
    echo $update_query ;
    if (!mysqli_query($conn, $update_query)) {
        echo "Error: ". mysqli_error($conn);
        exit;
    }

    header("location:category.php");
    exit;
}
?>
<?php
if (isset($_GET['id'])) {
    $id = (int) $_GET['id']; // cast to integer to prevent SQL injection
    $sql = "SELECT * FROM `category` WHERE id = $id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $category = $result->fetch_assoc(); // Fetch the product data
    } else {
        echo "Record not found";
        exit; // Add exit to prevent further execution
    }
} else {
    echo "ID parameter missing";
    exit; // Add exit to prevent further execution
    
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="update.css">
    <title>Category Page</title>
</head>

<body>
<form action="update.php" method="POST" enctype="multipart/form-data">
    <div class="top">
        <p>Category Update Details:</p>
    </div>
    <div class="category-name">
        <label for="cname">Category Name:</label>
        <input type="text" id="cname" value="<?php echo $category['category_name']?>" name="cname" placeholder="Enter Category Name" required>
    </div>

    <div class="status">
    <label for="status">Select Category Status:</label>
                        <select id="status" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive" selected>Inactive</option>
                        </select>
    </div>
    <input type="hidden" name="id" value="<?php echo $id?>">
    <button name="update" type="submit" class="upload">Update</button>
</form>

</body>
</html>