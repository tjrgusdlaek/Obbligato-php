<?php

include "Mysql_connection.php";


$get_Post_index= $_POST['get_Post_index'];
$get_Email= $_POST['get_Email'];
$get_Title= $_POST['get_Title'];
$get_QR= $_POST['get_QR'];
$Cancel_date= $_POST['Cancel_date'];
$Performance_date= $_POST['Performance_date'];
$Applier_token= $_POST['Applier_token'];
$Writer_token= $_POST['Writer_token'];
$Applier_my_name= $_POST['Applier_my_name'];

$response =array();
$response["result"] = false;


// $sql = "select * from `User` where `User_email`='$get_Email'";
// $result = mysqli_query($conn, $sql);
// $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
// $charged =$row['User_deposit_money'];


// $sql = "select * from `Obbligato_post` where `id`='$get_Post_index'";
// $result = mysqli_query($conn, $sql);
// $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
// $need_deposit =$row['Deposit_money'];
//     //자신의 보증금과 게시물의 보증금을 뺸다. 
// $charged_int = (int)$charged;
// $need_deposite_int = (int)$need_deposit;

// if($need_deposite_int > $charged_int){
//     $response["need_money"] = "보증금이 부족합니다";
//     echo json_encode($response);
//     return;
// }else if ($need_deposite_int <= $charged_int){

    // $charged = (string)$charged_int ;
    //보증금을 뺀 금액을 나에게 업데이트 한다.

    // $final_my_deposit_int =  $charged_int - $need_deposite_int ;
    // $final_my_deposit = (string)$final_my_deposit_int; 


    // $sql = "update `User` set `User_deposit_money` ='$final_my_deposit' where `User_email`='$get_Email'";
    // $result = mysqli_query($conn, $sql);

    // //관리자에게 보증금을 업데이트 해준다. 
    // $sql = "update `User` set `User_deposit_money` ='$need_deposit' where`User_email`='admin' and `User_name` ='admin' ";
    // $result = mysqli_query($conn, $sql);
    // $response["sql"] = $sql;


    // $sql = "select * from `Obbligato_post` where `id`='$get_Post_index'";
    // $result = mysqli_query($conn, $sql);
    // $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
    // $Contract_number =$row['Final_contract_number'];

    // //오브리에 필요한 인원에 대한 것을 업데이트 해준다. 
    // $Contract_number_int = (int)$Contract_number; 
    // $final_int = $Contract_number_int + 1 ;
    // $final_contract_number = (string)$final_int;
    // $Writer = $row['Writer_id'];

    // $sql = "update `Obbligato_post` set `Final_contract_number` ='$final_contract_number' where `id`='$get_Post_index' and `Writer_id`='$Writer' and `Title` ='$get_Title'";
    // $result = mysqli_query($conn, $sql);
    // $response["sql"] = $sql;

    $sql = "select * from `Chatting_room` where `Obbligato_index`='$get_Post_index'";
    $result = mysqli_query($conn, $sql);
    $rowCnt= mysqli_num_rows($result);
    $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
    if($rowCnt ===1){
       $Participate_member_email =  $row['Participate_person'];
       $Participate_member_token = $row['Participate_person_token'];
       $Participate_member_name = $row['Participate_person_name'];

       $update_member_email = $Participate_member_email .$get_Email.",";
       $update_member_token = $Participate_member_token . $Applier_token.",";
       $update_member_name = $Participate_member_name . $Applier_my_name.",";


       $sql = "update `Chatting_room` set `Participate_person` ='$update_member_email' ,`Participate_person_token` = '$update_member_token' , `Participate_person_name` = '$update_member_name' where `Obbligato_index`='$get_Post_index'";
       $result = mysqli_query($conn, $sql);

    }else{
        
    }



    $sql = "update `Apply_Request` set `Status` ='계약완료' where `Post_index`='$get_Post_index' and `Applier`='$get_Email' and `Post_title` ='$get_Title'";
    $result = mysqli_query($conn, $sql);
    // $response["sql"] = $sql;
  
    
 
    
    if($result){
        
        $sql = "select * from `Apply_Request` where `Post_index`='$get_Post_index' and `Applier`='$get_Email' and `Post_title` = '$get_Title'";
        $result = mysqli_query($conn, $sql);
        $response["sql"] = $sql;
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        $Apply_instrument = $row['Apply_instrument'];
        $Writer = $row['Writer'];
        // $response["result"] = true;


        
         
    if($result){
      

        $sql = "INSERT INTO `Final_contract` (`Post_index`,`Writer`,`Applier`,`Apply_instrument`,`Post_title`,`Qr_number`,`Performance_date`,`Cancel_date`,`Applier_token`,`Writer_token`) 
        VALUES('$get_Post_index','$Writer','$get_Email','$Apply_instrument','$get_Title','$get_QR','$Performance_date','$Cancel_date','$Applier_token','$Writer_token')";
        $result = mysqli_query($conn, $sql);
        $response["sql"] = $sql;
        
        if($result){
            $response["result"] = true;
            echo json_encode($response);
            // echo" 등록이 완료 되었습니다.";
        }
    }

     

   
    }else{
    
        echo json_encode($response);
        // echo" 등록이 되지않았습니다. ";
    }
    
// }




mysqli_close($conn);
?>