<?php
include "Mysql_connection.php";


$get_Email= $_POST['get_Email'];


$response =array();
// $sql = "select * from `Chatting_room` where `Sender`='$get_Email' or `Receiver` ='$get_Email'";
$sql = "select * from `Chatting_room`";

$result = mysqli_query($conn,$sql);


    $rowCnt= mysqli_num_rows($result);
    if($result){
    
    for($i=0;$i<$rowCnt;$i++){
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        $response[$i]= $row;
    }

    // $sort_array = array();
    // foreach ($response as $key => $row)
    // {
    //     $sort_array[$key] = $row['price'];
    // }
    // array_multisort($sort_array, SORT_DESC, $response);

        echo json_encode($response); 
    
    
    }else{
        echo "서버에서 보내지 못하였습니다";
    }




?>