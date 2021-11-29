<?php

include "Mysql_connection.php";

$get_Post_index= $_POST['get_Post_index'];


$response =array();
$response["result"] = false;

$sql = "update `Final_contract` set  `Status` ='1' where `id` = '$get_Post_index'";
$result = mysqli_query($conn, $sql);

$sql = "update `Obbligato_post` set  `Status` ='1' where `id` = '$get_Post_index'";
$result = mysqli_query($conn, $sql);

if($result){
    $response["result"] = true;
    echo json_encode($response);
 
}else{

    echo json_encode($response);

}

mysqli_close($conn);
?>