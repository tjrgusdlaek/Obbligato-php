<?php

include "Mysql_connection.php";

$get_Email= $_POST['get_Email'];
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
$Category= $_POST['Category'];
$get_Map_address= $_POST['get_Map_address'];
$get_Address_detail= $_POST['get_Address_detail'];
$get_Region_detail= $_POST['get_Region_detail'];
$MY_IMAGE= $_POST['MY_IMAGE'];
$MY_TOKEN= $_POST['MY_TOKEN'];




$response =array();
$response["result"] = false;

if(!$get_Email ||!$get_Title||!$get_Address||!$get_Need_instrument||!$get_Money||!$get_Deposit_money
||!$get_Performance_date||!$get_Cancel_date||!$get_Explain||!$get_Pay_rule||!$get_Practice||!$get_Latitude||!$get_Longitude||!$get_Region){
    echo json_encode($response);
}

$sql = "select * from User where User_email = '$get_Email'";
$result = mysqli_query($conn,$sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);
$get_Writer =  $row['User_name'];
$response["get_Writer"] = $get_Writer;



// $arr= array(); //빈 배열 생성
// $arr[1] = $get_Id;
// echo $get_Id;
$sql = "INSERT INTO `Obbligato_post` (`Writer_id`,`Writer`,`Title`,`Address`,`Need_instrument`,`Money`,`Deposit_money`,`Performance_date`,`Cancel_date`,`Explain`
,`Pay_rule`,`Practice`,`Region`,`Latitude`,`Longitude`,`Category`,`Map_address`,`Address_detail`,`Region_detail`,`User_profile_image`,`User_token`) 
VALUES('$get_Email','$get_Writer','$get_Title','$get_Address','$get_Need_instrument','$get_Money','$get_Deposit_money','$get_Performance_date','$get_Cancel_date'
,'$get_Explain','$get_Pay_rule','$get_Practice','$get_Region','$get_Latitude','$get_Longitude','$Category','$get_Map_address','$get_Address_detail','$get_Region_detail','$MY_IMAGE','$MY_TOKEN')";

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