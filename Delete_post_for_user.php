<?php

include "Mysql_connection.php";

$post_for_user_index= $_POST['post_for_user_index'];


$response =array();
$response["result"] = false;

$sql = "delete from `Post_for_user` where id = '$post_for_user_index'";

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