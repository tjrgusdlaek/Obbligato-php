<?php

include "Mysql_connection.php";


$get_Email= $_POST['get_Email'];

$response= array(); //빈 배열 생성
$response["result"] = false;
// $response["degree"] = $get_Degree;



$sql = "select * from `User` where `User_email`='$get_Email'" ;
$result = mysqli_query($conn, $sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);
// $response["sql"] = $sql;
    if($result){

        $response["result"] = true;
        $response["User_set_instrument"] = $row['User_set_instrument'];
        $response["User_region"] = $row['User_region'];
    
        echo json_encode($response); 

        
    }else{
        echo json_encode($response); 
    }

?>
