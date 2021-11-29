<?php
include "Mysql_connection.php";


$get_Email= $_POST['get_Email'];

$response= array();
$personal_roomlist =array(); 
$last_message = array(); 
$last_chattting_array = array(); 


$sql = "select * from `Chatting_room` where `Sender`='$get_Email' or `Receiver` ='$get_Email'";
$result = mysqli_query($conn,$sql);
$rowCnt= mysqli_num_rows($result);
// $response["rowCnt"] =   $rowCnt;

        for($j=0;$j<$rowCnt;$j++){
            $row = mysqli_fetch_assoc($result);
            if($row['id'] !== 'null'){
                $last_chattting_array[$j] = $row['id'];  
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

// for($h =0; $h<count($last_chattting_array); $h++){
    for($h =0; $h<sizeof($last_chattting_array); $h++){
    $sql = "select * from `Chatting` where `Chatting_index` = '$last_chattting_array[$h]' ORDER BY `id` desc LIMIT 1";
    $result = mysqli_query($conn,$sql);
    // $response["sql_$h"] = $sql;
    $row = mysqli_fetch_assoc($result);
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

        array_push($last_message,$last_message_array); 
}

 $group_last_chattting_array =array();
$sql = "select * from `Chatting_room` where `Participate_person` like '%$get_Email%'";
$result = mysqli_query($conn,$sql);
$rowCnt= mysqli_num_rows($result);

    for($j=0;$j<$rowCnt;$j++){
        $row = mysqli_fetch_assoc($result);
        if($row['id'] !== 'null'){
            $group_last_chattting_array[$j] = $row['id']; 
            $response["group_number_$j"] =   $group_last_chattting_array[$j];
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

    // for($h =0; $h<count($group_last_chattting_array); $h++){

        for($h =0; $h<sizeof($group_last_chattting_array); $h++){
        $sql = "select * from `Chatting` where `Chatting_index` = '$group_last_chattting_array[$h]' ORDER BY `id` desc LIMIT 1";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
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
            array_push($last_message,$group_last_message_array); 
    }
    $response['last_message'] = $last_message;
    

    // $response["pre_last_message"] = $last_message;
    
    foreach ((array) $last_message as $key => $value) {   
        $sort[$key] = $value['Chatting_message_id'];
    }
    array_multisort($sort, SORT_ASC, $last_message);


    // $response["after_last_message"] = $last_message;

    $response['roomlist'] = $personal_roomlist; 
    echo json_encode($response); 
?>