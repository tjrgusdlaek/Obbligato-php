<?php
include "Mysql_connection.php";


$get_Email= $_POST['get_Email'];
$post_index= $_POST['post_index'];



$response =array();
$response["result"] = false;


// $sql = "select * from `write_post_for_user` where   `User_id` = '$get_Email'";
// $result = mysqli_query($conn,$sql);
// $rowCnt= mysqli_num_rows($result);


$sql = "update `write_post_for_user` set `Status` ='삭제' where `Post_index`='$post_index' and `User_id`='$get_Email'";
$result = mysqli_query($conn, $sql);

        if($result){
            $response["result"] = "true";
            echo json_encode($response); 
            
        }else{
            echo json_encode($response); 
        }


    mysqli_close($conn);
?>