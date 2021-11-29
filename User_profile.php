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
$get_Belong= $_POST['get_Belong'];

$response= array(); //빈 배열 생성
$response["result"] = false;
// $response["degree"] = $get_Degree;

$file= $_FILES['img'];

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




if($get_Major === '비전공자'){
    $sql = "update User set `User_major_check` ='$get_Major',`User_profile_image`='$dstName' ,`User_introduce` ='$get_introduce',`User_career_open` ='',`User_graduate`='',`User_degree`='',`User_belong`='$get_Belong' where `User_email`='$get_Email'" ;
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

}else if($get_Major ==='전공자'){


    $sql = "update User set `User_major_check` ='$get_Major',`User_college`='$get_College',`User_profile_image`='$dstName' ,`User_instrument`='$get_Instrument',`User_introduce` ='$get_introduce',`User_career_open` ='$get_Career',`User_graduate`='$get_Graduate',`User_degree`='$get_Degree' where `User_email`='$get_Email'" ;
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
}


?>