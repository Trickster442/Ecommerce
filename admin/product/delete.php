<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM `product` WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo"
        <script>
        alert('Deleted successfully');
        window.location.href='../isAdmin.php';
        </script>
        ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "ID parameter missing";
}