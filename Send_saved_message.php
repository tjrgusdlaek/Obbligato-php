<?php
include "Mysql_connection.php";


$Receiver= $_POST['Receiver'];
$Sender= $_POST['Sender'];
$Chatting_index= $_POST['Chatting_index'];
$Category= $_POST['Category'];


$response =array();
$message_list_array = array();


if($Category === "개인"){
// $sql = "select * from `Chatting_room` where `id` = '$Chatting_index'";
// $result = mysqli_query($conn,$sql);
// $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
// $Out_time_array = explode(",", $row['Out_time']);  

//     if($row['Host'] === $Sender){
//         $Out_time = $Out_time_array[0];
//     }else{
//         $Out_time = $Out_time_array[1];
//     }



////채팅 테이블에서 인덱스 값에 맞는 메세지들 데이터만 가져온다 
$sql = "select * from `Chatting` where `Chatting_index` = '$Chatting_index' and  NOT `Receiver` = 'exit' and  NOT `Receiver` = 'join' ";
$result = mysqli_query($conn,$sql);
$rowCnt= mysqli_num_rows($result);
    for($o=0;$o<$rowCnt;$o++){
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);

        $non_reade_message_array = array(
            "Sender" => $row['Sender'],
            "Receiver" => $row['Receiver'],
            "Message" => $row['Message'],
            "Image" => $row['Image'],
            "Date" => $row['Date'],
            "Chatting_index" => $row['Chatting_index'],
            "Location_chatting" => $row['Location_chatting'],
            "Sender_name" => $row['Sender_name'],
            "Sender_profile_Image" => $row['Sender_profile_Image'],
            "id" => $row['id']
        );
        array_push($message_list_array,$non_reade_message_array);
    }



    ////상대방이 읽지 않은 채팅 가져오기 
    $miss_index_array = array();

        $sql = "select * from `Chatting` where  `Chatting_index` = '$Chatting_index' and  `Sender` = '$Receiver' and `Receiver` = 'exit' ORDER BY `id` desc LIMIT 1";
        $result = mysqli_query($conn,$sql);
     
        $rowCnt= mysqli_num_rows($result);

        if($rowCnt ===0){
            $sql = "select * from `Chatting` where  `Chatting_index` = '$Chatting_index'  and  `Sender` = '$Receiver' and  `Receiver` = 'join' ORDER BY `id` desc LIMIT 1";
            $result = mysqli_query($conn,$sql);
            $row= mysqli_fetch_array($result,MYSQLI_ASSOC);  

            $non_Read_index = $row['id'];
            $response['non_Read_index'] =$non_Read_index ; 
            // $miss_array = array(
            //     "id" =>$row['id']
            //     // "member_name" => $value['member_name']
            // );
            // array_push($miss_array_list,$miss_array); 
        }else{
            $row= mysqli_fetch_array($result,MYSQLI_ASSOC);  
            // $miss_array = array(
            //     "id" =>$row['id']
            //     // "member_name" => $value['member_name']
            // );
            // array_push($miss_array_list,$miss_array);    
            $non_Read_index = $row['id'];
            $response['non_Read_index'] =$non_Read_index ; 
        }


            // foreach ((array) $miss_array_list as $value) {   
                // if($value['id'] === null){
                //     $sql = "select * from `Chatting` where  `Chatting_index` = '$Chatting_index' and  NOT `Receiver` = 'exit'";
                //     $result = mysqli_query($conn,$sql);
                //     $rowCnt= mysqli_num_rows($result);
                //     for($z=0;$z<$rowCnt;$z++){
                //         // array_push($get_Member_array,$value['member_name']);
                //         $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
                //         // $index_array = array(
                //         //     "id" =>$row['id'],
                //         //     "member_name" => $value['member_name']
            
                //         // );
                //         array_push($miss_index_array,$row['id']);
                //     }
                // }else{


                $sql = "select * from `Chatting` where  `Chatting_index` = '$Chatting_index' and `id` >= '$non_Read_index' and  NOT `Receiver` = 'exit' and  NOT `Receiver` = 'join'";
                $result = mysqli_query($conn,$sql);
                $rowCnt= mysqli_num_rows($result);
                // $row= mysqli_fetch_array($result,MYSQLI_ASSOC);

                if($rowCnt ===0){
                    $index_array = array(
                        "id" =>"null",
                        "non_read_member_name" => $Receiver
        
                    );
                    array_push($miss_index_array,$index_array);

                }else{
                    for($z=0;$z<$rowCnt;$z++){
                        // array_push($get_Member_array,$value['member_name']);
                        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
                        $index_array = array(
                            "id" =>$row['id'],
                            "non_read_member_name" => $Receiver
            
                        );
                        array_push($miss_index_array,$index_array);
                    }
                }
                // }
            // }


    // foreach ((array) $miss_index_array as $key => $value) {   
    //     $sort[$key] = $value['id'];
    // }
    // array_multisort($sort, SORT_DESC, $last_message);

    $response['miss_array_list'] =$miss_array_list ; 
    $response['miss_index_array'] =$miss_index_array ; 
    $response['message_list_array'] =$message_list_array ; 
    echo json_encode($response); 








}else{ ////그룹일때 



    // $now_time = date("Y-m-d H:i:s"); //현재 시간 
    // $now_time_string  = strtotime(date("Y-m-d H:i:s"));



    //채팅의 마지막 메세지 
    // $sql = "select * from `Chatting` where `Chatting_index` = '$Chatting_index' ORDER BY `id` desc LIMIT 1";
    // $result = mysqli_query($conn,$sql);
    // $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
    // $last_message_time = $row['Date'];
    // $message_Sender = $row['Sender'];

    $sql = "select * from `Chatting` where  `Chatting_index` = '$Chatting_index' and `Sender` = '$Sender'  and `Receiver` = 'join'  ORDER BY `id` desc LIMIT 1";
    $result = mysqli_query($conn,$sql);
    $row= mysqli_fetch_array($result,MYSQLI_ASSOC);    
    $my_join_index  = $row['id'];



    $sql = "select * from `Chatting_room` where `id` = '$Chatting_index'";
    $result = mysqli_query($conn,$sql);
    $row= mysqli_fetch_array($result,MYSQLI_ASSOC);


    $people_email =  $row['Participate_person'];  ///룸 안의 사람들 이름을 가져온다  .

    $Participate_person_login_time = $row['Login_time']; //룸 안의 사람들 들어온 시간을 가져온다 . 

    $Participate_person_out_time = $row['Out_time'];//룸 안의 사람들 나간 시간을 가져온다 . 


    $Login_time_array = explode(",", $Participate_person_login_time); 
    $Out_time_array = explode(",",  $Participate_person_out_time); 
    $Participate_person_array = explode(",", $people_email); 


    $personlist_array =array(); ////나를 제외한 다른사람들의 

    // if($message_Sender === $Sender){
        ///현재 룸 안의 사람들 db의 인덱스를 알아낸다. 
        for($j =0; $j <sizeof($Participate_person_array)-1; $j ++) {
            if($Participate_person_array[$j] !== $Sender){
                // $person_index = $j ;
                $member_non_read_list = array(
                    "member_name" => $Participate_person_array[$j],
                    "Login_time" => $Login_time_array[$j]
                );
                array_push($personlist_array,$member_non_read_list);
            }
        }

        // and `Receiver` = 'exit'


        ///이 부분 수정해야됨 . 
        $miss_array_list = array();
        foreach ((array) $personlist_array as $value) {   
            $sql = "select * from `Chatting` where  `Chatting_index` = '$Chatting_index' and `Sender` = '$value[member_name]' ORDER BY `id` desc LIMIT 1";
            $result = mysqli_query($conn,$sql);
            $row= mysqli_fetch_array($result,MYSQLI_ASSOC);    
                $miss_array = array(
                    "id" =>$row['id'],
                    "member_name" => $value['member_name'],
                    // "Login_time" => $value['Login_time']
                );
                array_push($miss_array_list,$miss_array);    
        }

        // $sql = "select * from `Chatting` where  `Chatting_index` = '$Chatting_index' and `Sender` = '$Sender' and `Receiver` = 'exit' ORDER BY `id` desc LIMIT 1";
        // $result = mysqli_query($conn,$sql);
        // $row= mysqli_fetch_array($result,MYSQLI_ASSOC);    
        // $my_out_time = $row[]
     
    $Member_array =array();
    $get_Member_array =array();
    $miss_index_array = array();
    

    // and `Date` > '$value[Login_time]' 
    foreach ((array) $miss_array_list as $value) {   

        $sql = "select * from `Chatting` where  `Chatting_index` = '$Chatting_index' and `id` > '$value[id]'and  NOT `Receiver` = 'exit' and  NOT `Receiver` = 'join'  and NOT `Sender` ='$value[member_name]'  ";
        $result = mysqli_query($conn,$sql);
        $rowCnt= mysqli_num_rows($result);
     
        for($z=0;$z<$rowCnt;$z++){
            array_push($get_Member_array,$value['member_name']);
            $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
            // $index_array = array(
            //     "id" =>$row['id'],
            //     "member_name" => $value['member_name']

            // );
            array_push($miss_index_array,$row['id']);
            // array_push($miss_index_array, $index_array);
        }
    }
    $Member_array = array_unique($get_Member_array); ////어레이에 들어가있는 멤버들 중복검사해줌 

    foreach($Member_array as $value){  /// foreach 문을 돌려서 스트링 형식으로 클라이언트한테 보내줌 . 
        $non_read_member .= $value.",";  
    }

    /////채팅에 상대방이 안읽은 메세지들의 인덱스와 몇명이 안읽었는지 알려주는 함수 
    $final_array = array();

    for($z =0; $z <sizeof($miss_index_array); $z ++) {
        $current = $miss_index_array[$z];
        $non_read =0; 
        for($w = $z +1; $w <sizeof($miss_index_array); $w ++) {
            if($current === $miss_index_array[$w]){
                $non_read ++ ;
            }
        }
            if(array_search($current, array_column($final_array, 'id')) !== false) { ////만약에 컬럼에 아이디가 없다면 
            }else {
                $index_array = array(
                    "id" =>$current,
                    "read" => $non_read
                );   
                array_push($final_array,$index_array);    
            }
        }

        


        // foreach ((array) $miss_index_array as $value_message) {   
        //     $non_read =0; 
        //     $current = $value_message['id'];
        //     // $current_member = $value_message['member_name'];
        //     // array_push($get_Member_array,$current_member);


        //     foreach ((array) $miss_index_array as $value_miss) {   
        //             if($value_message['id'] === $value_miss['id']){

        //                 $non_read ++ ;
        //             }
        //     }

        //     if(array_search($current, array_column($final_array, 'id')) !== false) { ////만약에 컬럼에 아이디가 있다면  
        //     }else {
        //         $index_array = array(
        //             "id" =>$current,
        //             "read" => $non_read
                    
        //         );   
        //         array_push($final_array,$index_array);    
        //     }
        // }

        
       


        // //내 인덱스가 아니라면 나간날짜와 현재 날짜 비교 
        // for($p =0; $p <sizeof($Out_time_array)-1; $p ++) {
        //     if($p !== $person_index){
        //         // $changeTime = date("Y-m-d H:i:s", strtotime($now_time)) ;
        //         // $changeTime = strtotime($Out_time_array[$p]);
        //         if($Out_time_array[$p] <$last_message_time){                
        //             // $response["Out_time_array_$p"] =$Out_time_array[$p];
        //             $read_number ++ ;
        //             $not_read_member .= $Participate_person_array[$p] .","; 
        //         }
        //     }
        // }
        // // $response['not_read_member'] =$not_read_member ;

        // $not_read_member_array = explode(",",  $not_read_member); 


        // for($q =0; $q <sizeof($not_read_member_array)-1; $q ++) {
        //     if($not_read_member_array[$q] === $message_Sender){
        //         $read_number -- ; 
                
        //     }else{
        //         $final_not_read_member  .= $not_read_member_array[$q] .","; 
        //     }
     
        // }

        


    //채팅방의 채팅 내용을 보내준다 . 
    $sql = "select * from `Chatting` where `Chatting_index` = '$Chatting_index' and `id` >    $my_join_index  and  NOT `Receiver` = 'join' And NOT `Receiver` = 'exit' ORDER BY `id` ASC";
    $result = mysqli_query($conn,$sql);
    $rowCnt= mysqli_num_rows($result);
    for($o=0;$o<$rowCnt;$o++){

        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        $non_reade_message_array = array(
            "Sender" => $row['Sender'],
            "Receiver" => $row['Receiver'],
            "Message" => $row['Message'],
            "Image" => $row['Image'],
            "Date" => $row['Date'],
            "Chatting_index" => $row['Chatting_index'],
            "Location_chatting" => $row['Location_chatting'],
            "Sender_name" => $row['Sender_name'],
            "Sender_profile_Image" => $row['Sender_profile_Image'],
            "read" => "0",
            "id" => $row['id']
        );
        array_push($message_list_array,$non_reade_message_array);
    }
    

    // foreach ((array) $message_list_array as $key => $value) {   
    //     $sort[$key] = $value['id'];
    // }
    // array_multisort($sort, SORT_ASC, $message_list_array);

    

    // $non_read_number_array = array();

    //     foreach ((array) $message_list_array as $value_message) {   
    //         $non_read =0; 
    //         foreach ((array) $miss_index_array as $value_miss) {   
    //                 if($value_message['id'] === $value_miss['id']){

                  
    //                     // $non_read = (int)$value_message['read'];
    //                     $non_read ++; 
    //                     // $response['non_read'] =     $non_read  ; 
    //                     // $response['value_message'] =     $value_message['id']   ; 
    //                     // $get_non_read = (string)$non_read;
    //                     $non_read_nunmber= array(
    //                     "non_read_index" => $value_message['id'],
    //                     "non_number" => $non_read 
    //                     );

                    
    //                     array_push($non_read_number_array,$non_read_nunmber);
    //                 }
    //         }
    //     }


    // $response['final_not_read_member'] =$final_not_read_member ;
    // $response['now_time'] =$last_message_time ;

    // $response['non_read_number_array'] =$non_read_number_array ; 

    // $response['non_read_number_array'] =$non_read_number_array ; 


    $response['non_read_member'] =$non_read_member ; 
    $response['final_array'] =$final_array ; 
    // $response['miss_index_array'] =$miss_index_array ; 
    $response['miss_array_list'] =$miss_array_list ; 
    // $response['read_number'] =$read_number ; 
    $response['message_list_array'] =$message_list_array ; 
    echo json_encode($response); 

}
    mysqli_close($conn);
?>