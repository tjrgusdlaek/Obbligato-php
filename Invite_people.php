<?php
include "Mysql_connection.php";

$Invite_id= $_POST['Invite_id'];

$sql = "select * from `User` where `User_email` ='$Invite_id'";
$result = mysqli_query($conn,$sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);
$rowCnt= mysqli_num_rows($result);

$response =array();
$response["result"] = false;

if($result){
    if($rowCnt ===1){
        $response["result"] = true;
        $response['Invite_id'] = $row['User_email'];
        $response['Invite_name'] = $row['User_name'];
        $response['Invite_token'] = $row['User_token'];
    }
        echo json_encode($response); 
    
}else{
    echo "서버에서 보내지 못하였습니다";
}
?>