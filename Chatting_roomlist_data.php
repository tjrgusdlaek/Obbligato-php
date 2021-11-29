<?php
include "Mysql_connection.php";

// error_reporting(E_ALL);
// ini_set('display_errors', 1);


$get_Email= $_POST['get_Email'];
$response= array(); //빈 배열 생성
// $response["id"] = $get_Email;
// echo json_encode($response,JSON_UNESCAPED_UNICODE); 
/// 채팅 목록방 
$personal_roomlist =array(); 
///마지막 메세지 
$last_message = array(); 
/// 채팅의 목록을 담기위한  어레이리스트 
$last_chattting_array = array(); 
/// 채팅방 나간시간을 담기위한 어레이 리스트
$time_out_array =array(); 
/// 아직못본 메세지를 담기위한 어레이리스트
$miss_message_array =array(); 
 //그룹채팅창 마지막 메세지 
 $group_last_chattting_array =array();

 $my_chatting_room_index_array = array();

/// 개인 채팅방의 내가 속한 방 리스트를 가져온다 . 
$sql = "select * from `Chatting_room` where `Sender`='$get_Email' or `Receiver` ='$get_Email'";
$result = mysqli_query($conn,$sql);
$rowCnt= mysqli_num_rows($result);
// $response["rowCnt"] =   $rowCnt;

        for($j=0;$j<$rowCnt;$j++){
         $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
         $Out_time_array = explode(",", $row['Out_time']);   
            if($row['id'] !== 'null'){
                //새로운 어레이에 인덱스 값을 가져온다 . 
                $last_chattting_array[$j] = $row['id'];  
                $index = array(
                    "id" =>  $row['id']
                );

                array_push($my_chatting_room_index_array,$index);
                // $response["personal_number_$j"] =   $last_chattting_array[$j];
                $personal_array = array(
                    "Receiver" => $row['Receiver'],
                    "Sender" => $row['Sender'],
                    "Out_time" => $row['Out_time'],
                    "Category" => $row['Category'],
                    "Host" => $row['Host'],
                    "Participate_person_token" => $row['Participate_person_token'],
                    "Room_name" => $row['Room_name'],
                    "Participate_person" => $row['Participate_person'],
                    "Participate_person_name" => $row['Participate_person_name'],
                    "Receiver_name" => $row['Receiver_name'],
                    "Receiver_image" => $row['Receiver_image'],
                    "Sender_name" => $row['Sender_name'],
                    "Sender_image" => $row['Sender_image'],
                    "Sender_token" => $row['Sender_token'],
                    "Receiver_token" => $row['Receiver_token'],
                    "id" => $row['id']

                );
                // if($row['Sender'] === $get_Email){
                //     $out_time_list = array(
                //         "room_list_index" => $row['id'],
                //         // "Out_time" => $Out_time_array[0]
                //         "My_email" => $row['Sender']
                //     );
                //     array_push($time_out_array,$out_time_list);
                // }else{
                //     $out_time_list = array(
                //         "room_list_index" => $row['id'],
                //         // "Out_time" => $Out_time_array[1]
                //         "My_email" => $row['Receiver']
                //     );
                //     array_push($time_out_array,$out_time_list);
                // }
                array_push($personal_roomlist,$personal_array);
            }
         
        }

//개인 채팅방의 인덱스를 가지고 마지막 메세지 데이터를 가져온다 . 
// for($h =0; $h<count($last_chattting_array); $h++){
    for($h =0; $h<sizeof($last_chattting_array); $h++){
    $sql = "select * from `Chatting` where `Chatting_index` = '$last_chattting_array[$h]' And NOT `Receiver` = 'exit' And NOT `Receiver` = 'join'  ORDER BY `id` desc LIMIT 1";
    $result = mysqli_query($conn,$sql);
    // $response["sql_$h"] = $sql;
    $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
            $last_message_array = array(
                "Sender" => $row['Sender'],
                "Receiver" => $row['Receiver'],
                "Message" => $row['Message'],
                "Date" => $row['Date'],
                "Chatting_index" => $row['Chatting_index'],
                "Sender_name" => $row['Sender_name'],
                "Sender_profile_Image" => $row['Sender_profile_Image'],
                "Image" => $row['Image'],
                "Chatting_message_id" => $row['id']
            );

        //개인 방 리스트의 마지막 메세지를 가져온다. 
        array_push($last_message,$last_message_array); 
}







      

/// 그룹 채팅방의 의 내가 속한 방 리스트를 가져온다 . 
$sql = "select * from `Chatting_room` where `Participate_person` like '%$get_Email%'";
$result = mysqli_query($conn,$sql);
$rowCnt= mysqli_num_rows($result);
    for($j=0;$j<$rowCnt;$j++){
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        if($row['id'] !== 'null'){
            $group_index = array(
                "id" =>  $row['id']
            );

            array_push($my_chatting_room_index_array,$group_index);
            $group_last_chattting_array[$j] = $row['id']; 
            // array_push($my_chatting_room_index_array,$row['id']);
            $group_array = array(
                "Receiver" => $row['Receiver'],
                "Sender" => $row['Sender'],
                "Out_time" => $row['Out_time'],
                "Category" => $row['Category'],
                "Host" => $row['Host'],
                "Participate_person_token" => $row['Participate_person_token'],
                "Room_name" => $row['Room_name'],
                "Participate_person" => $row['Participate_person'],
                "Participate_person_name" => $row['Participate_person_name'],
                "Receiver_name" => $row['Receiver_name'],
                "Receiver_image" => $row['Receiver_image'],
                "Sender_name" => $row['Sender_name'],
                "Sender_image" => $row['Sender_image'],
                "Sender_token" => $row['Sender_token'],
                "Receiver_token" => $row['Receiver_token'],
                "id" => $row['id']
            );
 
          
            array_push($personal_roomlist,$group_array);
        }
    }


//   $get_Email = 'tjrgusdlaek1@naver.com';
//   echo $get_Email; 

//     $sql = "select * from `Chatting_room` where `Participate_person` like '%$get_Email%' ";
//     $result = mysqli_query($conn,$sql);
//     $rowCnt= mysqli_num_rows($result);
//     $row= mysqli_fetch_array($result,MYSQLI_ASSOC);

//     // echo $row['Participate_person'];
//     // echo $row['Out_time'];

//     $people_email =  $row['Participate_person'];
//     $people_time =  $row['Out_time'];

//     $group_Out_person_array = explode(",", $people_email);   
//     $group_Out_time_array = explode(",", $people_time ); 
  

//     // echo $group_Out_time_array[0]; 

//     for($o = 0; $o<sizeof($group_Out_person_array)-1; $o++){

//         // echo $group_Out_person_array[$i]; 
//         // $response["group_Out_person_array_"] = $group_Out_person_array[$k]; 
//         // $response["group_Out_time_array_"] = $group_Out_time_array; 
  

//         if($group_Out_person_array[$o] === $get_Email){
           
//             $group_out_time_list = array(
//             "room_list_index" => $row['id'],
//             "Out_time" => $group_Out_time_array[$o] 
//             );
//             // echo $group_out_time_list['room_list_index']; 
//             // echo $group_out_time_list['Out_time']; 
//             array_push($time_out_array,$group_out_time_list);
//     }
// }

//그룹 채팅방의 인덱스를 가지고 마지막 메세지 데이터를 가져온다 .
    for($h =0; $h<count($group_last_chattting_array); $h++){

        for($h =0; $h<sizeof($group_last_chattting_array); $h++){
        $sql = "select * from `Chatting` where `Chatting_index` = '$group_last_chattting_array[$h]' And NOT `Receiver` = 'join' And NOT `Receiver` = 'exit' ORDER BY `id` desc LIMIT 1";
        $result = mysqli_query($conn,$sql);
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
                $group_last_message_array = array(
                    "Sender" => $row['Sender'],
                    "Receiver" => $row['Receiver'],
                    "Message" => $row['Message'],
                    "Date" => $row['Date'],
                    "Chatting_index" => $row['Chatting_index'],
                    "Sender_name" => $row['Sender_name'],
                    "Sender_profile_Image" => $row['Sender_profile_Image'],
                    "Image" => $row['Image'],
                    "Chatting_message_id" => $row['id']
                   
                );
                //개인 방 리스트의 마지막 메세지를 가져온다. 
            array_push($last_message,$group_last_message_array); 
        }
    
    }
    // $response["pre_last_message"] = $last_message;
    
    ///다차원 배열 정렬 메세지 id 순서대로 정렬 
    foreach ((array) $last_message as $key => $value) {   
        $sort[$key] = $value['Chatting_message_id'];
    }
    array_multisort($sort, SORT_ASC, $last_message);

    
    // foreach ((array) $time_out_array as $value) {   
    //     $sql = "select * from `Chatting` where  `Chatting_index` = '$value[room_list_index]' and `Date` > '$value[Out_time]'";
    //     $result = mysqli_query($conn,$sql);
    //     $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
    //     $rowCnt= mysqli_num_rows($result);

    //     $miss_array = array(
    //         "miss_message" =>$rowCnt,
    //         "room_index" => $value['room_list_index']

    //     );
    //         array_push($miss_message_array,$miss_array);
    // }
//  $response["my_chatting_room_index_array"] = $my_chatting_room_index_array;


/// 각 채팅방에서 내가 나간 시간 다음에 몇개 더 들어왔는지를 확인한다. 
    foreach ((array) $my_chatting_room_index_array as $value) {   
        $sql = "select * from `Chatting` where  `Chatting_index` = '$value[id]' and `Sender`='$get_Email' and `Receiver` ='exit'  ORDER BY `id` desc LIMIT 1 ";
        $result = mysqli_query($conn,$sql);
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        $rowCnt= mysqli_num_rows($result);
        $exit_index = $row['id'];
        if($rowCnt === 0){
            $sql = "select * from `Chatting` where  `Chatting_index` = '$value[id]' and `Sender`='$get_Email' and `Receiver` ='join'  ORDER BY `id` desc LIMIT 1 ";
            $result = mysqli_query($conn,$sql);
            $row= mysqli_fetch_array($result,MYSQLI_ASSOC);

            $miss_array = array(
                "miss_message" =>$row['id'],
                "room_index" => $value['id']

            );
                array_push($miss_message_array,$miss_array);
        }else{
            $sql = "select * from `Chatting` where  `Chatting_index` = '$value[id]' and `Sender`='$get_Email' and `Receiver` ='join'  ORDER BY `id` desc LIMIT 1 ";
            $result = mysqli_query($conn,$sql);
            $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
            $join_index = $row['id'];

            if($join_index > $exit_index){
                $miss_array = array(
                    "miss_message" =>$join_index,
                    "room_index" => $value['id']
    
                );
                    array_push($miss_message_array,$miss_array);
            }else{
                $miss_array = array(
                    "miss_message" =>$exit_index,
                    "room_index" => $value['id']
    
                );
                    array_push($miss_message_array,$miss_array);
            }

         
        }
    }
    // $response["miss_message_array"] = $miss_message_array; 

    $final_miss_message = array();
    foreach ((array) $miss_message_array as $value) {   
        if($value['miss_message'] !== null){
        $sql = "select * from `Chatting` where  `Chatting_index` = '$value[room_index]' and `id` > $value[miss_message]  And NOT `Receiver` = 'join' And NOT `Receiver` = 'exit' and not `Sender` ='$get_Email'";
        $result = mysqli_query($conn,$sql);
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        $rowCnt= mysqli_num_rows($result);

        $final_miss_array = array(
            "miss_message" =>$rowCnt,
            "room_index" => $value['room_index']

        );
            array_push($final_miss_message,$final_miss_array);
    }else{  ////이 부분을 어떻게 해야할지 아직 정하지않았음 .  And NOT `Receiver` = 'exit' and not `Sender` ='$get_Email'
        $sql = "select * from `Chatting` where  `Chatting_index` = '$value[room_index]' and `Receiver` like '%$get_Email%' ";
        $result = mysqli_query($conn,$sql);
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        $rowCnt= mysqli_num_rows($result);

        $_miss_array = array(
            "miss_message" =>$rowCnt,
            "room_index" => $value['room_index']

        );
        array_push($final_miss_message,$_miss_array);
    }
    }

    // $response["after_last_message"] = $last_message;

    /// 개인 메세지 방 리스트를 객체에 담아 넣어준다 . 

    
    // $response["time_out_array"] = $time_out_array; 
    $response["final_miss_message"] = $final_miss_message; 
    $response['roomlist'] = $personal_roomlist; 
    $response['last_message'] = $last_message;
    echo json_encode($response,JSON_UNESCAPED_UNICODE); 


    mysqli_close($conn);
?>