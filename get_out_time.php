<?php
include "Mysql_connection.php";

$Chatting_index= $_POST['Chatting_index'];



$response =array();

$sql = "select * from `Chatting_room` where `id`='$Chatting_index'";
$result=mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$Out_time = $row['Out_time'];


    if($result){
    // for($i=0;$i<$rowCnt;$i++){
    //     $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        $response['result']= true ;
        $response['Out_time']= $Out_time ;
        
    // }

        echo json_encode($response); 
    
    
    }else{
        // echo "서버에서 보내지 못하였습니다";
    }




?>