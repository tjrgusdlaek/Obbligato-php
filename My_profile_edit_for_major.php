<?php

include "Mysql_connection.php";


$get_Email= $_POST['get_Email'];
$get_Major= $_POST['get_Major'];
$get_College= $_POST['get_College'];
$get_Graduate= $_POST['get_Graduate'];
$get_Career= $_POST['get_Career'];
$get_Degree= $_POST['get_Degree'];
$get_Instrument= $_POST['get_Instrument'];
$get_introduce= $_POST['get_introduce'];


$response= array(); //빈 배열 생성
$response["result"] = false;
// $response["degree"] = $get_Degree;

    $sql = "update User set `User_major_check` ='$get_Major',`User_college`='$get_College',`User_instrument`='$get_Instrument',`User_introduce` ='$get_introduce',`User_career_open` ='$get_Career',`User_graduate`='$get_Graduate',`User_degree`='$get_Degree' where `User_email`='$get_Email'" ;
    $result = mysqli_query($conn, $sql);
    // $response["sql"] = $sql;
    if($result){
        $response["result"] = true;
        echo json_encode($response); 
        // echo "프로필을 입력하였습니다";
    }else{
        echo json_encode($response); 
        // echo "프로필을 입력 못하였습니다 ";
    }

?>