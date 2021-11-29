<?php

include "Mysql_connection.php";


$get_Email= $_POST['get_Email'];
$get_sp_location= $_POST['get_sp_location'];
$get_sp_instrument= $_POST['get_sp_instrument'];

$response= array(); //빈 배열 생성
$response["result"] = false;
// $response["degree"] = $get_Degree;



    $sql = "update User set `User_region`='$get_Region' ,`User_set_instrument` ='$get_sp_instrument'  where `User_email`='$get_Email'" ;
    $result = mysqli_query($conn, $sql);
    $response["sql"] = $sql;
    if($result){

        $sql = "select * from `User` where `User_email`='$get_Email'" ;
        $result = mysqli_query($conn, $sql);
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        // $response["sql"] = $sql;

        if($result){

        $response["result"] = true;
        $response["User_location"] = $row['User_region'];
        $response["User_set_instrument"] = $row['User_set_instrument'];

        echo json_encode($response); 

        }else{

        echo json_encode($response); 
        
        }
    }else{
        echo json_encode($response); 
    }

?>
