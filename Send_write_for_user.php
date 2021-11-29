<?php
include "Mysql_connection.php";


$get_Email= $_POST['get_Email'];


$response =array();

$room_post_index_array = array(); // 룸 인덱스를 담기위한 어레이 리스트
$obbli_post_room_data =array();  // 클라이언트로 보낼 룸 데이터 어레이 리스트
// group by `Post_index`

    $sql = "select * from `write_post_for_user` where `User_id` ='$get_Email' and not `Status` ='삭제'";
    $result = mysqli_query($conn,$sql);
    $rowCnt= mysqli_num_rows($result);
 

    if($result){
    
    for($i=0;$i<$rowCnt;$i++){
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        $room_post_index_array[$i] = $row['Post_index'];  
 
    }
      
    
    

    for($j=0;$j<sizeof($room_post_index_array);$j++){
        $sql = "select * from `Obbligato_post` where  `id` ='$room_post_index_array[$j]' ";
        $result = mysqli_query($conn,$sql);
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        $obbli_data_array = array(
            "Title" => $row['Title'],
            "id" => $row['id']

        );
        array_push($obbli_post_room_data,$obbli_data_array);
    }
      




    $response['obbligato_data'] = $obbli_post_room_data; 

        echo json_encode($response); 

    }else{
        echo "서버에서 보내지 못하였습니다";
    }


    mysqli_close($conn);

?>