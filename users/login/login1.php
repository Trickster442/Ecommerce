<?php
include("config.php");


$email = $_POST['email'];
$password = $_POST['password'];


$result = mysqli_query($conn," SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password' AND `is_admin` is NULL");

if(mysqli_num_rows($result)){
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