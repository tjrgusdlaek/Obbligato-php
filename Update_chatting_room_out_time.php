<?php
include "Mysql_connection.php";


$Chatting_index= $_POST['Chatting_index'];
$Update_Participate_people_out_time= $_POST['Update_Participate_people_out_time'];




$response =array();
$response["result"] = false;

$sql = "update `Chatting_room` set `Out_time` ='$Update_Participate_people_out_time' where `id`='$Chatting_index'";

$result = mysqli_query($conn,$sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);


if($result){
    $response["result"] = true;

    $response["Update_Participate_people_out_time"] = $Update_Participate_people_out_time;  
    echo json_encode($response); 
    
}else{
    echo json_encode($response); 
}
?>