<?php

include "Mysql_connection.php";


$get_Post_index= $_POST['get_Post_index'];
$get_Email= $_POST['get_Email'];
$get_Title= $_POST['get_Title'];
$User_email= $_POST['User_email'];

$response =array();
$response["result"] = false;



$sql = "update `Apply_Request` set `Status` ='수락' where `Post_index`='$get_Post_index' and `Writer`='$get_Email' and `Post_title` ='$get_Title' and `Applier` = '$User_email'";

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