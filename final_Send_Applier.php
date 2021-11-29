<?php
include "Mysql_connection.php";

$get_Title= $_POST['get_Title'];
$get_Post_index= $_POST['get_Post_index'];


$array =array();
$response =array();
$Status =array();

$sql = "select * from `Final_contract` where `Post_title` ='$get_Title' and `Post_index` ='$get_Post_index'";
$array["sql"]= $sql;
// echo json_encode($array); 
$result = mysqli_query($conn,$sql);
$rowCnt= mysqli_num_rows($result);
 
if($result){

    for($i=0;$i<$rowCnt;$i++){
     $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
    //  if($row['Status'] === 1){
      
    //  }else{
        $array[$i]= $row['Applier'];
        //  echo json_encode($array); 
             
    //  }
    }

    }else{
        echo "서버에서 보내지 못하였습니다";
    }

for($j =0; $j<count($array); $j++){
$sql = "select * from `User` where `User_email` ='$array[$j]'";
// $response[$j]= $sql;
$result = mysqli_query($conn,$sql);
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        $response[$j]= $row;
       
}

echo json_encode($response);


?>