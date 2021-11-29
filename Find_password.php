<?php
include "Mysql_connection.php";

$get_Name= $_POST['get_Name'];
$get_Id= $_POST['get_Id'];



$response =array();
$response["result"] =false; 

$sql = "select * from `User` where `User_name` ='$get_Name' and `User_email` ='$get_Id'";
// $array["sql"]= $sql;
// echo json_encode($array); 
$result = mysqli_query($conn,$sql);
// $rowCnt= mysqli_num_rows($result);
 
if($result){
    $response["result"] =true; 
    // for($i=0;$i<$rowCnt;$i++){
     $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
     $response['password']= $row['User_password'];

    // }
     echo json_encode($response); 

    }else{
    
    }



echo json_encode($response);


?>