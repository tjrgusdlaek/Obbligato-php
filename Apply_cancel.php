<?php

include "Mysql_connection.php";

$get_Post_index= $_POST['get_Post_index'];
$get_Email= $_POST['get_Email'];

$response =array();
$response["result"] = false;

$sql = "delete from `Apply_Request` where `Applier` = '$get_Email' and `Post_index` = '$get_Post_index' ";
$response["sql"] = $sql;
$result = mysqli_query($conn, $sql);

if($result){
    $response["result"] = true;
    echo json_encode($response);
    // echo" 등록이 완료 되었습니다.";
}else{

    echo json_encode($response);
    // echo" 등록이 되지않았습니다. ";
}


?>