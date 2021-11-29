<?php
include "Mysql_connection.php";


$Chatting_index= $_POST['Chatting_index']; // 채팅방 인덱스 
$Update_Participate_people_out_time= $_POST['Update_Participate_people_out_time']; ///업데이트 해줘야할 사람의 어레이 인덱스 값을 가져옴 
$member_index =  (int)$Update_Participate_people_out_time; // 어레이 인덱스 int 값으로 바꿔주기 
$response["member_index"] = $member_index ;


$response =array();
$response["result"] = false;


$sql = "select * from `Chatting_room` where `id` = '$Chatting_index'";
$result = mysqli_query($conn,$sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);

$member_time  = $row['Out_time'];
$Out_time_array = explode(",", $member_time);

$now_time = date("Y-m-d H:i:s"); //현재 시간 

$response["now_time"] = $now_time ;
$response["Out_time_array"] = $Out_time_array ;

$response["count(Out_time_array)"] = sizeof($Out_time_array);

for($i = 0 ; $i<sizeof($Out_time_array); $i ++){
    if($i === $member_index){
        $Out_time_array[$i] = $now_time;
    }
}
$response["Out_time_array2"] = $Out_time_array ;

$update_time ="";
for($j = 0 ; $j<sizeof($Out_time_array)-1;  $j ++){
    $update_time .= $Out_time_array[$j].",";
    $response["Out_time_array[$j]"] = $Out_time_array[$j] ;
    $response["Out_time_array[$j]"] = $update_time ;
}





$sql = "update `Chatting_room` set `Out_time` ='$update_time' where `id`='$Chatting_index'";
$result = mysqli_query($conn,$sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);


if($result){
    $response["result"] = true;

    $response["Update_Participate_people_out_time"] = $update_time;  
    echo json_encode($response); 
    
}else{
    echo json_encode($response); 
}
?>