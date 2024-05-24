<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e_commerce";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$A_email = $_POST['email'];
$A_password = $_POST['password'];

$result = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$A_email' AND password = '$A_password' AND is_admin = 1");

if (mysqli_num_rows($result)) {
    echo "
        <script>
        alert('Login successfully');
        window.location.href='../isAdmin.php';
        </script>
    ";
} else {
    echo "
        <script>
        alert('Invalid Username/password or you are not an admin');
        window.location.href='login.php';
        </script>
    ";
}
mysqli_close($conn);