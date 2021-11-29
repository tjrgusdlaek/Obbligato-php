<?php
include "Mysql_connection.php";

$get_Title= $_POST['get_Title'];
$get_Post_index= $_POST['get_Post_index'];
$User_email= $_POST['User_email'];

$array =array();


$sql = "select * from `Apply_Request` where `Post_title` ='$get_Title' and `Post_index` ='$get_Post_index' and `Applier` = '$User_email'";
// $array["sql"]= $sql;
// echo json_encode($array); 
$result = mysqli_query($conn,$sql);
$rowCnt= mysqli_num_rows($result);
 
if($result){

    for($i=0;$i<$rowCnt;$i++){
     $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
     $array['Status']= $row['Status'];
     echo json_encode($array); 
          
    }

    }else{
        echo "서버에서 보내지 못하였습니다";
    }
    
?>