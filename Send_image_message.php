<?php

include "Mysql_connection.php";



$User_name= $_POST['User_name'];
$get_Writer= $_POST['get_Writer'];
$get_Applier= $_POST['get_Applier'];
$get_Time= $_POST['get_Time'];
$file= $_FILES['img'];
// $Title= $_POST['Title'];
$Chatting_index= $_POST['Chatting_index'];
$User_image= $_POST['User_image'];



// $roomname = $get_Writer.$get_Applier;


$response= array(); //빈 배열 생성
$response["result"] = false;
// $response["degree"] = $get_Degree;


//이미지 파일을 영구보관하기 위해
//이미지 파일의 세부정보 얻어오기
$srcName= $file['name'];
$tmpName= $file['tmp_name']; //php 파일을 받으면 임시저장소에 넣는다. 그곳이 tmp

//임시 저장소 이미지를 원하는 폴더로 이동
$dstName= "upload/".date('Ymd_his').$srcName;
$result=move_uploaded_file($tmpName, $dstName);

if($result){
//  echo "upload success";
}else{
//  echo "upload fail";
return;
}



// $sql = "INSERT INTO `Chatting`(`Receiver`,`Sender`,`Image`,`Date`,`Post_title`,`Chatting_index`) VALUES('$get_Writer','$get_Applier','$dstName','$get_Time','$Title','$Chatting_index')";
$sql = "INSERT INTO `Chatting`(`Receiver`,`Sender`,`Image`,`Date`,`Chatting_index`,`Sender_name`,`Sender_profile_Image`) VALUES('$get_Writer','$get_Applier','$dstName','$get_Time','$Chatting_index','$User_name','$User_image')";
$result = mysqli_query($conn, $sql);



if($result){
    $response["result"] =true; 
    $response["image"] = $dstName ;
    echo json_encode($response); 

}else{
    echo json_encode($response); 

}


?>