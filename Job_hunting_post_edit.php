<?php

include "Mysql_connection.php";


$get_Post_index= $_POST['get_Post_index'];
$get_Title= $_POST['get_Title'];
$get_Name= $_POST['get_Name'];
$get_College= $_POST['get_College'];
$get_Instrument= $_POST['get_Instrument'];
$get_Introduce= $_POST['get_Introduce'];
$get_Degree= $_POST['get_Degree'];
$get_Location= $_POST['get_Location'];
$get_Hourly_pay= $_POST['get_Hourly_pay'];
$get_Hope_pay= $_POST['get_Hope_pay'];


$response =array();
$response["result"] = false;

if(!$get_Title ||!$get_Name||!$get_College||!$get_Instrument||!$get_Introduce||!$get_Degree
||!$get_Location||!$get_Hourly_pay||!$get_Hope_pay||!$get_Post_index){
    echo json_encode($response);
}

// $sql = "select * from User where User_email = '$get_Email'";
// $result = mysqli_query($conn,$sql);
// $get_Writer =  $row['User_name'];

// $arr= array(); //빈 배열 생성
// $arr[1] = $get_Id;
// echo $get_Id;
$sql = "update `Job_hunting_post` set `Post_title` ='$get_Title', `User_name` ='$get_Name',`User_college` ='$get_College',`User_instrument`='$get_Instrument',
`User_introduce`='$get_Introduce',`User_degree`='$get_Degree',`User_hope_location`='$get_Location',`User_hope_houly_pay`='$get_Hourly_pay',
`User_hope_pay`='$get_Hope_pay' where `id`='$get_Post_index'";

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