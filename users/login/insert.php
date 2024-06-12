<?php
include('config.php');

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['pNumber'];
    $password = $_POST['password'];

    $Dup_email = mysqli_query($conn," SELECT * FROM `users` WHERE email = '$email' ");
    $Dup_number = mysqli_query($conn," SELECT * FROM `users` WHERE phone_number = '$phone_number' ");
    
    if(mysqli_num_rows($Dup_email)){
        echo"
            <script>
                alert('This email is already taken');
                window.location.href='register.php' ;
            </script>

        ";
    }

    if(mysqli_num_rows($Dup_number)){
        echo"
            <script>
                alert('This number is already taken');
                window.location.href='register.php' ;
            </script>

        ";
    }
    else{
        mysqli_query($conn, " INSERT INTO `users`(`name`, `email`, `phone_number`, `password`) VALUES ('$name' , '$email', '$phone_number', '$password') ");
    }
}

header('location:../index.php');