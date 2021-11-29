<?php

include "Mysql_connection.php";



$User_name= $_POST['User_name'];
$get_Writer= $_POST['get_Writer'];
$get_Applier= $_POST['get_Applier'];
$get_message= $_POST['get_message'];
$get_Time= $_POST['get_Time'];
// $Title= $_POST['Title'];
$Chatting_index= $_POST['Chatting_index'];
$User_image= $_POST['User_image'];

// $roomname = $get_Writer.$get_Applier;


$response= array(); //빈 배열 생성
$response["result"] = false;




// $sql = "INSERT INTO `Chatting`(`Receiver`,`Sender`,`Message`,`Date`,`Post_title`,`Chatting_index`) VALUES('$get_Writer','$get_Applier','$get_message','$get_Time','$Title','$Chatting_index')";
$sql = "INSERT INTO `Chatting`(`Receiver`,`Sender`,`Message`,`Date`,`Chatting_index`,`Sender_name`,`Sender_profile_Image`) VALUES('$get_Writer','$get_Applier','$get_message','$get_Time','$Chatting_index','$User_name','$User_image')";
$result = mysqli_query($conn, $sql);


if($result){
    $response["result"] =true; 
  
    echo json_encode($response); 

}else{
    echo json_encode($response); 

}


?>