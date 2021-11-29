<?php
include "Mysql_connection.php";


$Category= $_POST['Category'];

if($Category ==='개인'){

$Sender= $_POST['Sender'];
$Receiver= $_POST['Receiver'];
$Chatting_index= $_POST['Chatting_room_index'];
$Out_time= $_POST['Out_time'];


$sql = "select * from  `Chatting` where  `Chatting_index` ='$Chatting_index' and `Date` > '$Out_time' ";
$result = mysqli_query($conn,$sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);
$rowCnt= mysqli_num_rows($result);


$response =array();

$response['Miss_message'] = $rowCnt;

$sql = "select * from `User` where `User_email` = '$Receiver'";
$result = mysqli_query($conn,$sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);

if($result){
   
    $response['User_name'] = $row['User_name'];
    $response['User_image'] = $row['User_profile_image'];
    $response['User_token'] = $row['User_token'];

    
//////채팅에서 Chatting_index 를 그룹으로 한다음에 id 중에 제일 마지막 하나를 가져온다. (마지막 메세지를 가져오기 위한 select 문 )
$sql = "select * from  (select * from `Chatting` where (`Receiver` = '$Receiver' and `Sender` = '$Sender') or (`Receiver` ='$Sender' and `Sender` ='$Receiver') ORDER BY `id` desc LIMIT 18446744073709551615) `Chatting` group by `Chatting_index`";
$result = mysqli_query($conn,$sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);
$rowCnt= mysqli_num_rows($result);
        if($result){
            if($rowCnt >= 1){
            $response['Message'] = $row['Message'];
            if($row['Image'] ==="" || $row['Image'] ==="null"){
                $row['Image'] = "";
            }
            $response['Image'] = $row['Image'];
            $response['Date'] = $row['Date'];
            $response['Chatting_index'] = $row['Chatting_index'];
            $response['Chatting_message_index'] = $row['id'];
            
            // $response[0]= $row;

            echo json_encode($response); 
            }

        }else{
            echo json_encode($response);
        }


}else{

    echo json_encode($response);

}

}else if($Category === '그룹'){

    $Room_name= $_POST['Room_name'];
    $Participate_person= $_POST['Participate_person'];
    $Chatting_index= $_POST['Chatting_room_index'];
    $Out_time= $_POST['Out_time'];


    $sql = "select * from  `Chatting` where  `Chatting_index` ='$Chatting_index' and `Date` > '$Out_time' ";
    $result = mysqli_query($conn,$sql);
    $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
    $rowCnt= mysqli_num_rows($result);

    $response['Miss_message'] = $rowCnt;

    $my_id= $_POST['my_id'];
    
    $sql = "select * from  `Chatting_room` where `Room_name`= '$Room_name' and `Participate_person` = '$Participate_person' ";
    $result = mysqli_query($conn,$sql);
    $row= mysqli_fetch_array($result,MYSQLI_ASSOC);

    if($result){
        $response['Participate_person'] = $row['Participate_person'];
        $response['Participate_person_token'] = $row['Participate_person_token'];
        $response['Chatting_room_index'] = $row['id'];
        $response['Host'] = $row['Host'];
        $response['Participate_person_name'] = $row['Participate_person_name'];
        // $response['Out_time'] = $row['Out_time'];
        
        $sql = "select * from  (select * from `Chatting` where ( `Chatting_index` ='$Chatting_index') ORDER BY `id` desc LIMIT 18446744073709551615) `Chatting` group by `Chatting_index`";
        $result = mysqli_query($conn,$sql);
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        $rowCnt= mysqli_num_rows($result);
        if($result){
        
            if($rowCnt >= 1){
            $response['Message'] = $row['Message'];
            if($row['Image'] ==="" || $row['Image'] ==="null"){
                $row['Image'] = "";
            }
            $response['Image'] = $row['Image'];
            $response['Date'] = $row['Date'];
            $response['Chatting_index'] = $row['Chatting_index'];
            $response['Chatting_message_index'] = $row['id'];

            echo json_encode($response);
            } 
        }else{
            
            echo json_encode($response);
            }
    

    }else{
            
        echo json_encode($response);
        }





}

?>