<?php
include "Mysql_connection.php";


$Room_name= $_POST['Room_name'];
$Chatting_room_index= $_POST['Chatting_room_index'];

$response =array();


$sql = "select * from `Group_chatting` where `Room_name` = '$Room_name' limit 1";
$result = mysqli_query($conn,$sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        if($result){
   
            $response['Message'] = $row['Message'];
            $response['Image'] = $row['Image'];
            $response['Date'] = $row['Date'];
            $response['Room_name'] = $row['Room_name'];
            $response['Chatting_message_index'] = $row['id'];
            
            // $response[0]= $row;

            echo json_encode($response); 

        }else{
            
        echo "서버에서 보내지 못하였습니다";
        }

?>