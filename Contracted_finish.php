<?php

include "Mysql_connection.php";

$post_index= $_POST['post_index'];
$writer= $_POST['writer'];
$applier= $_POST['applier'];


$response =array();
$response["result"] = false;

$sql = "select * from `User` where `User_email`='$applier'";
$result = mysqli_query($conn, $sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);
$charged =$row['User_deposit_money']; //사용자의 현재 충전 보증금 
$charged_int =  (int)$charged;

$sql = "select * from `Obbligato_post` where `id`='$post_index'";
$result = mysqli_query($conn, $sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);
$need_deposit =$row['Deposit_money']; //게시물의 보증금 

$need_deposite_int = (int)$need_deposit;
$return_deposit_int = ($need_deposite_int * 95 /100) + $charged_int ;
$return_deposit = (string)$return_deposit_int; 

//보증금의 5%를 뺀 나머지 금액을 돌려받는다. 
$sql = "update `User` set `User_deposit_money` ='$return_deposit' where `User_email`='$applier'";
$result = mysqli_query($conn, $sql);


$sql = "select * from `User` where `User_email`='admin'";
$result = mysqli_query($conn, $sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);
$charged =$row['User_deposit_money'];
$charged_int =  (int)$charged;

$subtraction = $charged_int - ($need_deposite_int * 95 /100) ;

$return_deposit_int = ($need_deposite_int * 5 /100) + $subtraction ;
$return_deposit = (string)$return_deposit_int; 


//관리자의 보증금을 업데이트 해준다. 
$sql = "update `User` set `User_deposit_money` ='$return_deposit' where`User_email`='admin' and `User_name` ='admin' ";
$result = mysqli_query($conn, $sql);
$response["sql"] = $sql;



$sql = "delete from `Apply_Request` where `Post_index`='$post_index' and `Writer`='$writer' and `Applier` = '$applier'";
$result = mysqli_query($conn, $sql);
$response["sql"] = $sql;

// $sql = "delete from `Final_contract` where `Post_index`='$post_index' and `Writer`='$writer' and `Applier` = '$applier'";
// $result = mysqli_query($conn, $sql);
$sql = "update `Final_contract` set `Status` ='1' where `Post_index`='$post_index' and `Writer`='$writer' and `Applier` = '$applier'";
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