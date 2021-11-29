<?php

include "Mysql_connection.php";

$get_Email= $_POST['get_Email'];
$get_Charge= $_POST['get_Charge'];

$response =array();
$response["result"] = false;


$sql = "select * from `User` where `User_email`='$get_Email'";
$result = mysqli_query($conn, $sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);
$charged =$row['User_deposit_money'];

$charged_int = (int)$charged;

$get_Charge_int = (int)$get_Charge;

$final_my_deposit_int = $get_Charge_int + $charged_int; 
$final_my_deposit = (string)$final_my_deposit_int;

$sql = "update `User` set `User_deposit_money`='$final_my_deposit' where `User_email`='$get_Email'";
$result = mysqli_query($conn, $sql);
$response["sql"] = $sql;

if($result){
    $response["result"] = true;
    echo json_encode($response);
    // echo" 등록이 완료 되었습니다.";
}else{

    echo json_encode($response);
    // echo" 등록이 되지않았습니다. ";
}


?>