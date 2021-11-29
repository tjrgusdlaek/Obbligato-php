<?php

include "Mysql_connection.php";

$get_Email= $_POST['get_Email'];
$get_Password= $_POST['get_Password'];



// $token = $_POST['token'];
// if($token !==null && $row['Usertoken'] ===null){
//     // echo "1들어옴";
//     $sql="update Users set Usertoken ='$token' where Userid ='$id'";
//     $result = mysqli_query($conn,$sql);    
// }else{
//     // echo "2들어옴";
// }


$response =array();
$response["result"] = false;
// $response["profile_check"] = false;

// $response[1]=$get_Id;
// $response[2]=$get_Password;
$sql = "select * from User where User_email = '$get_Email'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

    if( $row['User_password']===$get_Password){
        $response["result"] = true;        
        $response["User_major_check"] = $row['User_major_check'];
        $response["User_token"] = $row['User_token'];
        $response["User_name"] = $row['User_name'];
        $response["User_profile_image"] = $row['User_profile_image'];
        
        // if($row['User_major_check'] !== null){
        //     $response["profile_check"] = true; 
        //     echo json_encode($response);
        //     return;
            
        // }else if($row['User_major_check'] ==='null' || $row['User_major_check'] ===""){
        //     $response["profile_check"] = false; 
            echo json_encode($response);
        // }
    }else{
        echo json_encode($response); 
    }



 
?>