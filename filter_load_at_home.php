<?php
include "Mysql_connection.php";


$get_Email= $_POST['get_Email'];
$User_region= $_POST['User_region'];
$User_set_instrument= $_POST['User_set_instrument'];


$response =array();
// $array =array();


if($User_region ==="null" || $User_region ==='설정안함' ||$User_region ===""){

    $sql = "select * from `Obbligato_post`";
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

    $sql = "select * from `Obbligato_post` where `Region` ='$User_region'";
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