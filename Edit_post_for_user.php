<?php

include "Mysql_connection.php";


$post_for_user_index= $_POST['post_for_user_index'];
$message= $_POST['message'];
$time= $_POST['time'];


$response =array();
$response["result"] = false;


$sql = "update `Post_for_user` set `Message` ='$message', `Date` ='$time' where `id`='$post_for_user_index'";

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