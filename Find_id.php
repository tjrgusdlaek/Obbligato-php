<?php
include "Mysql_connection.php";

$get_Name= $_POST['get_Name'];
$get_Number= $_POST['get_Number'];



$response =array();
$response["result"] =false; 

$sql = "select * from `User` where `User_name` ='$get_Name' and `User_phone_number` ='$get_Number'";
// $array["sql"]= $sql;
// echo json_encode($array); 
$result = mysqli_query($conn,$sql);
// $rowCnt= mysqli_num_rows($result);
 
if($result){
    $response["result"] =true; 
    // for($i=0;$i<$rowCnt;$i++){
     $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
     $response['id']= $row['User_email'];

    // }
     echo json_encode($response); 

    }else{
    
    }



echo json_encode($response);


?>