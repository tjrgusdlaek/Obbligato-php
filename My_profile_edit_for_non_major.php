<?php

include "Mysql_connection.php";


$get_Email= $_POST['get_Email'];
$get_Major= $_POST['get_Major'];
$get_Belong= $_POST['get_Belong'];
$get_introduce= $_POST['get_introduce'];

$response= array(); //빈 배열 생성
$response["result"] = false;
// $response["degree"] = $get_Degree;

$sql = "update User set `User_major_check` ='$get_Major' ,`User_introduce` ='$get_introduce',`User_career_open` ='',`User_graduate`='',`User_degree`='',`User_belong`='$get_Belong' where `User_email`='$get_Email'" ;
$result = mysqli_query($conn, $sql);
// $response["sql"] =   $sql;
if($result){
    // $response["sql"] =   $sql;
    $response["result"] = true;
    // echo "프로필을 입력하였습니다";
          echo json_encode($response); 
}else{
    echo json_encode($response); 
    // echo "프로필을 입력 못하였습니다 ";
}

?>