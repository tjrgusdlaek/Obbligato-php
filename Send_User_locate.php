<?php
include "Mysql_connection.php";


$get_Email= $_POST['get_Email'];


$response =array();

$sql = "select * from `User` where `User_email` ='$get_Email'";
$result = mysqli_query($conn,$sql);


    if($result){
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        $get_Region = $row["User_region"];
        $response["get_Region"]= $get_Region;
        echo json_encode($response); 
    }else{
        echo "서버에서 보내지 못하였습니다";
    }




?>