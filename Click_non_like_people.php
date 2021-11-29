<?php
include "Mysql_connection.php";

$get_Email= $_POST['get_email'];

$sql = "select * from `User` where `User_email` ='$get_Email'";
$result = mysqli_query($conn,$sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);

$response =array();
$response["result"] = false;


$get_liked_number = $row['User_liked_number'];
$number = 1; 
$get_liked_number_int  = (int)$get_liked_number;
$liked_number = $get_liked_number_int - $number  ; 
$return_like_number = (string)$liked_number; 


$sql = "update `User` set `User_liked_number` ='$return_like_number' where `User_email`='$get_Email'";
$result = mysqli_query($conn,$sql);
if($result){

        $response["result"] = true;
        $response["sql"] = $sql;    
        $response["return_like_number"] = $return_like_number;
        $response["get_liked_number"] = $get_liked_number_int;
        $response["liked_number"] = $liked_number;
        echo json_encode($response); 
    
}else{
    echo "서버에서 보내지 못하였습니다";
}
?>