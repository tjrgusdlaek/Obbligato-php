<?php

include "Mysql_connection.php";

$get_Post_index= $_POST['get_Post_index'];
$get_Title= $_POST['get_Title'];
$get_Address= $_POST['get_Address'];
$get_Need_instrument= $_POST['get_Need_instrument'];
$get_Money= $_POST['get_Money'];
$get_Deposit_money= $_POST['get_Deposit_money'];
$get_Performance_date= $_POST['get_Performance_date'];
$get_Cancel_date= $_POST['get_Cancel_date'];
$get_Explain= $_POST['get_Explain'];
$get_Pay_rule= $_POST['get_Pay_rule'];
$get_Practice= $_POST['get_Practice'];
$get_Latitude= $_POST['get_Latitude'];
$get_Longitude= $_POST['get_Longitude'];
$get_Region= $_POST['get_Region'];
// $Category= $_POST['Category'];
$get_Map_address= $_POST['get_Map_address'];
$get_Address_detail= $_POST['get_Address_detail'];
$get_Region_detail= $_POST['get_Region_detail'];


$response =array();
$response["result"] = false;

if(!$get_Post_index ||!$get_Title||!$get_Address||!$get_Need_instrument||!$get_Money||!$get_Deposit_money
||!$get_Performance_date||!$get_Cancel_date||!$get_Explain||!$get_Pay_rule||!$get_Practice||!$get_Latitude||!$get_Longitude||!$get_Region||!$get_Map_address){
    echo json_encode($response);
}

// $sql = "select * from User where User_email = '$get_Email'";
// $result = mysqli_query($conn,$sql);
// $get_Writer =  $row['User_name'];

// $arr= array(); //빈 배열 생성
// $arr[1] = $get_Id;
// echo $get_Id;
$sql = "update Obbligato_post set `Title` ='$get_Title', `Address` ='$get_Address',`Need_instrument` ='$get_Need_instrument',`Money`='$get_Money',`Deposit_money`='$get_Deposit_money'
,`Performance_date`='$get_Performance_date',`Cancel_date`='$get_Cancel_date',`Explain`='$get_Explain',`Pay_rule`='$get_Pay_rule',`Practice`='$get_Practice',`Latitude`='$get_Latitude'
,`Longitude`='$get_Longitude',`Map_address`='$get_Map_address',`Address_detail`='$get_Address_detail',`Region`='$get_Region',`Region_detail`='$get_Region_detail'   where `id`='$get_Post_index'";

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