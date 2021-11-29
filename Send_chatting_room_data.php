<?php
include "Mysql_connection.php";


$Sender= $_POST['Sender'];
$Receiver= $_POST['Receiver'];
// $Title= $_POST['Title'];


$response =array();

// $sql = "select * from `Chatting_room` where `Title` = '$Title' and (`Sender`='$Sender' and `Receiver` ='$Receiver') or (`Sender`='$Receiver' and `Receiver` ='$Sender')";
$sql = "select * from `Chatting_room` where  (`Sender`='$Sender' and `Receiver` ='$Receiver') or (`Sender`='$Receiver' and `Receiver` ='$Sender')";
$result = mysqli_query($conn,$sql);


    $rowCnt= mysqli_num_rows($result);
    if($result){
    
    for($i=0;$i<$rowCnt;$i++){
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        $response[$i]= $row;
    }
        echo json_encode($response); 
    
    
    }else{
        echo "서버에서 보내지 못하였습니다";
    }




?>