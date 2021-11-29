<?php
include "Mysql_connection.php";

$Update_Participate_people= $_POST['Update_Participate_people'];
$Update_Participate_people_name= $_POST['Update_Participate_people_name'];
$Update_Participate_people_token= $_POST['Update_Participate_people_token'];
$Chatting_index= $_POST['Chatting_index'];
$Update_Participate_people_out_time= $_POST['Update_Participate_people_out_time'];




$response =array();
$response["result"] = false;

$sql = "update `Chatting_room` set `Participate_person` ='$Update_Participate_people', `Participate_person_token` ='$Update_Participate_people_token'
,`Participate_person_name`='$Update_Participate_people_name' ,`Out_time` ='$Update_Participate_people_out_time' where `id`='$Chatting_index'";

$result = mysqli_query($conn,$sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);


if($result){
    $response["result"] = true;
    $response["Update_Participate_people"] = $Update_Participate_people;
    $response["Update_Participate_people_token"] = $Update_Participate_people_token;
    $response["Update_Participate_people_name"] = $Update_Participate_people_name;  
    $response["Update_Participate_people_out_time"] = $Update_Participate_people_out_time;  
    echo json_encode($response); 
    
}else{
    echo json_encode($response); 
}
?>