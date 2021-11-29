<?php
include "Mysql_connection.php";

$get_Email= $_POST['get_Email'];

$sql = "select * from `User` where User_email ='$get_Email'";
$result = mysqli_query($conn,$sql);

$response =array();

// $rowCnt= mysqli_num_rows($result);

if($result){
   
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        $response[0]= $row;
    
        echo json_encode($response); 
    
}else{
    echo "서버에서 보내지 못하였습니다";
}
?>