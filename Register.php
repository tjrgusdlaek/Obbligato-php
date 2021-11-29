<?php

include "Mysql_connection.php";

$get_Name= $_POST['get_Name'];
$get_Email= $_POST['get_Email'];
$get_Password= $_POST['get_Password'];
$get_Phone_number1= $_POST['get_Phone_number1'];
$get_Phone_number2= $_POST['get_Phone_number2'];
$get_Phone_number3= $_POST['get_Phone_number3'];
$User_token= $_POST['User_token'];


$phone_number = $get_Phone_number1.$get_Phone_number2.$get_Phone_number3;

$arr= array(); //빈 배열 생성

if(!$get_Name){
    echo "이름을 입력해주세요";
    return;
}else if(!$get_Password){
    echo "비밀번호를 입력해주세요";
    return;
}else if(!$get_Email){
    echo "이메일을 입력해주세요";
    return;
}else if(!$get_Phone_number1 || !$get_Phone_number2 ||!$get_Phone_number3){
    echo "전화번호를 입력해주세요";
    return;
}


$sql = "INSERT INTO `User`(`User_name`,`User_password`,`User_email`,`User_phone_number`,`User_token`) VALUES('$get_Name','$get_Password','$get_Email','$phone_number','$User_token')";
$result = mysqli_query($conn, $sql);

$arr[1] = $phone_number;

if($result){
    // echo json_encode($arr); 
    echo "회원가입이 완료되었습니다";
}else{
    // echo json_encode($arr); 
    echo "회원가입 실패";
}


?>