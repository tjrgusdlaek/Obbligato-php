<?php

include "Mysql_connection.php";

$MY_IMAGE= $_POST['MY_IMAGE'];
$MY_NAME= $_POST['MY_NAME'];
$message= $_POST['message'];
$time= $_POST['time'];

$get_email= $_POST['get_email'];

$response= array(); //빈 배열 생성
$response["result"] =false; 

$sql = "INSERT INTO `Post_for_user`(`User_id`,`Writer`,`Message`,`Date`,`User_image`) VALUES('$get_email','$MY_NAME','$message','$time','$MY_IMAGE')";
$result = mysqli_query($conn, $sql);

if($result){
    $sql = "select * from `Post_for_user` where `Writer` ='$MY_NAME' and `Message`='$message' and `Date` = '$time'";
    $result = mysqli_query($conn,$sql);
   
    if($result){
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        $response["index"] =$row['id']; 
        $response["result"] =true; 
        echo json_encode($response); 

    }else{
        echo json_encode($response); 
    }
  
}else{
    echo json_encode($response); 
}


?>