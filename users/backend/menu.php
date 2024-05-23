<?php
    require './data/datab.php';
    header('Access-Control-Allow-Origin:*');
    if($_SERVER['REQUEST_METHOD']==="GET"){
        $stmt = "SELECT category_name from category where status=\"Active\"";
        if($result = $conn->query($stmt)){
            $arr = array();
            while($name = $result->fetch_assoc()['name']){
                array_push($arr, $name);
            }
            echo json_encode(['categories'=> $arr]);
        }
        else{
            echo json_encode(['error'=> 'something went wrong, try again later']);
        }
        exit();
    }
