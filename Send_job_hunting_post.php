<?php
include "Mysql_connection.php";

$get_Email= $_POST['get_Email'];

$response =array();


$sql = "select * from `User` where `User_email` ='$get_Email'";
$result = mysqli_query($conn,$sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);
$get_Region = $row["User_region"];
// $response["get_Region"]= $get_Region;

if($get_Region ==null || $get_Region ==='설정안함'){

    $sql = "select * from `Job_hunting_post`";
    $result = mysqli_query($conn,$sql);
    $rowCnt= mysqli_num_rows($result);
    if($result){
    
    for($i=0;$i<$rowCnt;$i++){
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        $response[$i]= $row;
    }
        echo json_encode($response); 
    
    
    }else{
        echo "서버에서 보내지 못하였습니다";
    }

}else {

    $sql = "select * from `Job_hunting_post` where `User_hope_location` ='$get_Region'";
    $result = mysqli_query($conn,$sql);
    $rowCnt= mysqli_num_rows($result);
    if($result){
    
    for($i=0;$i<$rowCnt;$i++){
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        $response[$i]= $row;
    }
        echo json_encode($response); 
    
    
    }else{
        echo "서버에서 보내지 못하였습니다";
    }


}
?>