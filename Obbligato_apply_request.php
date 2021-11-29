<?php

include "Mysql_connection.php";

$get_Writer_id= $_POST['get_Writer_id'];
$Apply_id= $_POST['Apply_id'];
$Apply_instrument= $_POST['Apply_instrument'];
$get_Title= $_POST['get_Title'];
$get_Post_index= $_POST['get_Post_index'];
$Region= $_POST['Region'];
$Region_detail= $_POST['Region_detail'];
$get_Date= $_POST['get_Date'];
$Cancel_date= $_POST['Cancel_date'];



$response =array();
$response["result"] = false;



$sql = "select * from `User` where `User_email`='$Apply_id'";
$result = mysqli_query($conn, $sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);
$charged =$row['User_deposit_money'];

$sql = "select * from `User` where `User_email` ='$Apply_id'";
$result = mysqli_query($conn,$sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);

$get_Instrument =$row['User_instrument'];

if($get_Instrument !== $Apply_instrument){
  
    $response["Fail_reason"] = "사용자님의 악기와 요청악기가 다릅니다.";
    //  echo "악기가 다릅니다. ";
    echo json_encode($response);
     return;
}

$sql = "select * from `Apply_Request` where `Applier` ='$Apply_id' and `Post_index` = '$get_Post_index'";
$result = mysqli_query($conn,$sql);
// $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
$rowCnt= mysqli_num_rows($result);

if($rowCnt==1){
    $response["Fail_reason"] = "이미 신청된 오브리 입니다.";
    echo json_encode($response);
    //  echo "악기가 다릅니다. ";
     return;
}

$sql = "select * from `Obbligato_post` where `id`='$get_Post_index'";
$result = mysqli_query($conn, $sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);

$need_deposit =$row['Deposit_money'];
    //자신의 보증금과 게시물의 보증금을 뺸다. 
$charged_int = (int)$charged;
$need_deposit_int = (int)$need_deposit;

if($need_deposit_int > $charged_int){

    $response["Fail_reason"] = "보증금이 부족합니다";
    echo json_encode($response);
    return;

}else if ($need_deposit_int <= $charged_int){

    $final_my_deposit_int =  $charged_int - $need_deposit_int ;
    $final_my_deposit = (string)$final_my_deposit_int; 


    $sql = "update `User` set `User_deposit_money` ='$final_my_deposit' where `User_email`='$Apply_id'";
    $result = mysqli_query($conn, $sql);

    $sql = "select * from `User` where `User_email`='admin'";
    $result = mysqli_query($conn, $sql);
    $row= mysqli_fetch_array($result,MYSQLI_ASSOC);

    $charged =$row['User_deposit_money'];
    $charged_int = (int)$charged;

    $return_deposit_int = $charged_int + $need_deposit_int ; 
    $return_deposit = (string) $return_deposit_int;

    //관리자에게 보증금을 업데이트 해준다. 
    $sql = "update `User` set `User_deposit_money` ='$return_deposit' where `User_email`='admin' and `User_name` ='admin' ";
    $result = mysqli_query($conn, $sql);
    $response["sql"] = $sql;

    if($result){
        // $response["result"] = true;
        // echo json_encode($response);
        // echo" 등록이 완료 되었습니다.";

        
$sql = "INSERT INTO `Apply_Request` (`Writer`,`Applier`,`Apply_instrument`,`Post_title`,`Post_index`,`Region`,`Region_detail`,`Date`,`Cancel_date`) 
VALUES('$get_Writer_id','$Apply_id','$Apply_instrument','$get_Title','$get_Post_index','$Region','$Region_detail','$get_Date','$Cancel_date')";

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

    }else{
    
        echo json_encode($response);
        // echo" 등록이 되지않았습니다. ";
    }

}
?>