<?php
include "Mysql_connection.php";


$get_Email= $_POST['get_email'];
$my_id= $_POST['my_id'];



$response =array();
$response["result"] = false;
$sql = "select * from `Final_contract` where (`Writer`='$get_Email' &&  `Applier` = '$my_id' OR `Writer`='$my_id' &&  `Applier` = '$get_Email' ) AND `Status` ='1' ";
$result = mysqli_query($conn,$sql);
$rowCnt= mysqli_num_rows($result);


$response["rowcnt"] = $rowCnt;

    if($result){

        if($rowCnt >=1){
            $response["result"] = "true";
        }else{
            $response["result"] = "false";
        }
       
        echo json_encode($response); 
        
    }else{
        echo "서버에서 보내지 못하였습니다";
    }




?>