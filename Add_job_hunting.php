<?php

include "Mysql_connection.php";

$get_Email= $_POST['get_Email'];
$get_Title= $_POST['get_Title'];
$get_Name= $_POST['get_Name'];
$get_College= $_POST['get_College'];
$get_Instrument= $_POST['get_Instrument'];
$get_Introduce= $_POST['get_Introduce'];
$get_Degree= $_POST['get_Degree'];
$get_Location= $_POST['get_Location'];
$get_Hourly_pay= $_POST['get_Hourly_pay'];
$get_Hope_pay= $_POST['get_Hope_pay'];
$Category= $_POST['Category'];
$get_Detail_location= $_POST['get_Detail_location'];
$User_profile_image= $_POST['User_profile_image'];
$User_token= $_POST['User_token'];


$response =array();
$response["result"] = false;

$sql = "select * from `User` where User_email = '$get_Email'";
$result = mysqli_query($conn, $sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);

$User_profile = $row['User_profile_image'];

if(!$User_profile){
    $User_profile = "";
}

if(!$get_Email ||!$get_Title||!$get_Name||!$get_College||!$get_Instrument||!$get_Degree
||!$get_Location||!$get_Hourly_pay||!$get_Hope_pay||!$Category){
    $response["false"] = "입력이 제대로 되지않았습니다.";
    echo json_encode($response);
}

// $arr= array(); //빈 배열 생성
// $arr[1] = $get_Id;
// echo $get_Id;
$sql = "INSERT INTO `Job_hunting_post` (`User_profile_image`,`User_id`,`User_name`,`User_college`,`User_degree`,`User_hope_houly_pay`,`User_hope_pay`,`Post_title`,`Category`,`User_hope_location`,`User_instrument`,`User_introduce`,`Region_detail`,`User_token`,`User_profile_image`) 
VALUES('$User_profile','$get_Email','$get_Name','$get_College','$get_Degree','$get_Hourly_pay','$get_Hope_pay','$get_Title','$Category','$get_Location','$get_Instrument','$get_Introduce','$get_Detail_location','$User_token','$User_profile_image')";

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