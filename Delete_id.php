<?php
include "Mysql_connection.php";

$get_Email= $_POST['get_Email'];
$get_Name= $_POST['get_Name'];
$get_Deposit_money= $_POST['get_Deposit_money'];

$response =array();
$response["result"] =false; 

// `User_name` ='$get_Name' and `User_email` ='$get_Id'";

if($get_Deposit_money !== '0'){
$need_deposite_int = (int)$get_Deposit_money;
$sql = "select * from `User` where `User_email`='admin'";
$result = mysqli_query($conn, $sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);
$admin_charged =$row['User_deposit_money'];
$admin_charged_int =  (int)$admin_charged;

$subtraction = $admin_charged_int +$need_deposite_int;
$admin_return_deposit = (string)$subtraction; 


//관리자의 보증금을 업데이트 해준다. 
$sql = "update `User` set `User_deposit_money` ='$admin_return_deposit' where `User_email`='admin' and `User_name` ='admin' ";
$result = mysqli_query($conn, $sql);
// $response["sql"] = $sql;
}


$sql = "delete from `User` where `User_name` = '$get_Name' and `User_email` ='$get_Email'";
$result = mysqli_query($conn,$sql);
// $rowCnt= mysqli_num_rows($result);
 
if($result){
    $response["result"] =true; 
     echo json_encode($response); 

    }else{
    echo json_encode($response); 
    }

?>