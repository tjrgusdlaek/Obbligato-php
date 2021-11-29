<?php
include "Mysql_connection.php";

$get_group_people_id= $_POST['get_group_people_id'];
$get_group_people_name= $_POST['get_group_people_name'];
$get_group_people_token= $_POST['get_group_people_token'];
$Chatting_index= $_POST['Chatting_index'];
$get_group_people_out_time= $_POST['get_group_people_out_time'];


$response =array();
$response["result"] = false;

$sql = "update `Chatting_room` set `Participate_person` ='$get_group_people_id', `Participate_person_token` ='$get_group_people_token'
,`Participate_person_name`='$get_group_people_name' ,`Out_time` = '$get_group_people_out_time'  where `id`='$Chatting_index'";

// $response["sql"] = $sql;
$result = mysqli_query($conn,$sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);

$sql = "select * from `Chatting_room` where `id` = '$Chatting_index'";
$result = mysqli_query($conn,$sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);

if($result){
    $response["result"] = true;
    $response["get_group_people_id"] = $row['Out_time'];
    // $response["get_group_people_name"] = $row;
    // $response["get_group_people_out_time"] = $row;
        echo json_encode($response); 
    
}else{
    echo json_encode($response); 
}
?>