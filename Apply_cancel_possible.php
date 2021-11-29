<?php

include "Mysql_connection.php";

$get_Post_index= $_POST['get_Post_index'];
$get_Email= $_POST['get_Email'];
$get_Title= $_POST['get_Title'];
$Writer= $_POST['Writer'];  


$response =array();
$response["result"] = false;

$sql = "select * from `User` where `User_email`='$get_Email'";
$result = mysqli_query($conn, $sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);
$charged =$row['User_deposit_money']; //사용자의 현재 충전 보증금 
$charged_int =  (int)$charged;

$sql = "select * from `Obbligato_post` where `id`='$get_Post_index'";
$result = mysqli_query($conn, $sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);
$need_deposit =$row['Deposit_money']; //게시물의 보증금 

$need_deposite_int = (int)$need_deposit;
$return_deposit_int = ($need_deposite_int * 95 /100) + $charged_int ;
$return_deposit = (string)$return_deposit_int; 

//보증금의 5%를 뺀 나머지 금액을 돌려받는다. 
$sql = "update `User` set `User_deposit_money` ='$return_deposit' where `User_email`='$get_Email'";
$result = mysqli_query($conn, $sql);


$sql = "select * from `User` where `User_email`='admin'";
$result = mysqli_query($conn, $sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);
$admin_charged =$row['User_deposit_money'];
$admin_charged_int =  (int)$admin_charged;

$subtraction = $admin_charged_int - ($need_deposite_int * 95 /100) ;

$admin_return_deposit_int = ($need_deposite_int * 5 /100) + $subtraction ;
$admin_return_deposit = (string)$admin_return_deposit_int; 


//관리자의 보증금을 업데이트 해준다. 
$sql = "update `User` set `User_deposit_money` ='$admin_return_deposit' where `User_email`='admin' and `User_name` ='admin' ";
$result = mysqli_query($conn, $sql);
$response["sql"] = $sql;



$sql = "update `Apply_Request` set `Status` ='계약취소_가능' where `Post_index`='$get_Post_index' and `Writer`='$Writer' and `Post_title` ='$get_Title' and `Applier` = '$get_Email'";
$result = mysqli_query($conn, $sql);
// $response["sql"] = $sql;

if($result){
    $response["result"] = true;
    echo json_encode($response);
    // echo" 등록이 완료 되었습니다.";
}else{

    echo json_encode($response);
    // echo" 등록이 되지않았습니다. ";
}

?>