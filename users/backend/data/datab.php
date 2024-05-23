<?php
$servername= "localhost";
$username= "root";
$password= "";
$dbname= "e_commerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_errno){
    echo json_encode(['error' => $conn->connect_error]);
    exit();
}