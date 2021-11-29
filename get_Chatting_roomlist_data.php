<?php
include "Mysql_connection.php";


$get_Email= $_POST['get_Email'];


$response =array();



$personal_roomlist =array(); /// 채팅 목록방 
$last_message = array(); ///마지막 메세지 
$last_chattting_array = array(); /// 채팅의 목록을 담기위한  어레이리스트 
$group_last_chattting_array =array(); //그룹채팅창 마지막 메세지 


/// 개인 채팅방의 내가 속한 방 리스트를 가져온다 . 
$sql = "select * from `Chatting_room` where `Sender`='$get_Email' or `Receiver` ='$get_Email'";
$result = mysqli_query($conn,$sql);
$rowCnt= mysqli_num_rows($result);
// $response["rowCnt"] =   $rowCnt;

        for($j=0;$j<$rowCnt;$j++){
            $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
            if($row['id'] !== 'null'){
                $last_chattting_array[$j] = $row['id'];  //새로운 어레이에 인덱스 값을 가져온다 . 
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
                    "id" => $row['id']
                
                );
                array_push($personal_roomlist,$personal_array);
            }
         
        }
     
    
//개인 채팅방의 인덱스를 가지고 마지막 메세지 데이터를 가져온다 . 
// for($h =0; $h<count($last_chattting_array); $h++){
    for($h =0; $h<sizeof($last_chattting_array); $h++){
    $sql = "select * from `Chatting` where `Chatting_index` = '$last_chattting_array[$h]' ORDER BY `id` desc LIMIT 1";
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
        
        array_push($last_message,$last_message_array); //개인 방 리스트의 마지막 메세지를 가져온다. 
}

      


/// 그룹 채팅방의 의 내가 속한 방 리스트를 가져온다 . 
$sql = "select * from `Chatting_room` where `Participate_person` like '%$get_Email%' and  `Category` = '그룹'";
$result = mysqli_query($conn,$sql);
$rowCnt= mysqli_num_rows($result);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);

    for($j=0;$j<$rowCnt;$j++){
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        if($row['id'] !== 'null'){
            $group_last_chattting_array[$j] = $row['id']; 
            // $response["group_number_$j"] =   $group_last_chattting_array[$j];
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
                "id" => $row['id']
            );
            array_push($personal_roomlist,$group_array);
        }
    }

//그룹 채팅방의 인덱스를 가지고 마지막 메세지 데이터를 가져온다 .
    // for($h =0; $h<count($group_last_chattting_array); $h++){

        for($h =0; $h<sizeof($group_last_chattting_array); $h++){
        $sql = "select * from `Chatting` where `Chatting_index` = '$group_last_chattting_array[$h]' ORDER BY `id` desc LIMIT 1";
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
            array_push($last_message,$group_last_message_array); //개인 방 리스트의 마지막 메세지를 가져온다. 
    }
    

    // $response["pre_last_message"] = $last_message;

    foreach ((array) $last_message as $key => $value) {   ///다차원 배열 정렬 메세지 id 순서대로 정렬 
        $sort[$key] = $value['Chatting_message_id'];
    }
    array_multisort($sort, SORT_ASC, $last_message);


    // $response["after_last_message"] = $last_message;

    $response['roomlist'] = $personal_roomlist; /// 개인 메세지 방 리스트를 객체에 담아 넣어준다 . 
    $response['last_message'] = $last_message;

    echo json_encode($response,JSON_UNESCAPED_UNICODE); 
    

     

?>