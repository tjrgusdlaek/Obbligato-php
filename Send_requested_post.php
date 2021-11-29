<?php
include "Mysql_connection.php";

$get_Email= $_POST['get_Email'];


$response =array();

$sql = "select * from `Apply_Request` where `Writer` ='$get_Email' and not `Status` ='계약끝' group by `Post_title`";
$result = mysqli_query($conn,$sql);
// $row= mysqli_fetch_array($result,MYSQLI_ASSOC);

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

    mysqli_close($conn);
?>