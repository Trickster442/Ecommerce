<?php
include("config.php");

$name = $_POST['name'];
$password = $_POST['password'];

$result = mysqli_query($conn," SELECT * FROM `users` WHERE (`name` = '$name' OR `email` = '$name' ) AND `password` = '$password' AND `is_admin` is NULL");

if ($row = mysqli_fetch_assoc($result)) {
    $username = $row['name']; // Assuming 'name' is the column name in the database
    // $user_id = $row['user_id'];
} else {
    echo "No user found with the provided credentials.";
}
session_start();
if(mysqli_num_rows($result)){
    $_SESSION['user'] = $username;
    // $_SESSION['user_id'] = $user_id;
    echo"
            <script>
                alert('Login Successfully');
                window.location.href='../index.php' ;
            </script>

        ";
}
else{
    echo"
            <script>
                alert('Email and password did not match!!!');
                window.location.href='login.php' ;
            </script>

        ";
}