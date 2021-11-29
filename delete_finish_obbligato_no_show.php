<?php

include "Mysql_connection.php";

$get_Post_index= $_POST['get_Post_index'];
$no_show_people= $_POST['no_show_people'];
$MY_ID= $_POST['MY_ID'];




$response =array();
$response["no_show_people"] = $no_show_people;
$response["result"] = false;

//최종계약 db의 데이터들을 업데이트 시켜준다. 
$sql = "update `Final_contract` set  `Status` ='1' where `Post_index` = '$get_Post_index'";
$result = mysqli_query($conn, $sql);

///오브리 게시물의 상태를 업데이트 시켜준다. 
$sql = "update `Obbligato_post` set  `Status` ='1' where `id` = '$get_Post_index'";
$result = mysqli_query($conn, $sql);


//오브리의 보증금이 얼마인지 가져온다. 
$sql = "select * from `Obbligato_post` where `id` ='$get_Post_index'";
$result = mysqli_query($conn,$sql);
$obbli_deposit_money = $row['Deposit_money']; //오브리 보증금 . 
$obbli_deposit_money_int = (int)$obbli_deposit_money;


$sql = "select * from `User` where `User_email` ='$MY_ID'";
$result = mysqli_query($conn,$sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);
$my_deposit_money =$row['User_deposit_money'];


$my_deposit_money_int = (int)$my_deposit_money; ///작성자 본인의 보증금 업데이트 
$return_my_deposit_int = $obbli_deposit_money_int + $my_deposit_money_int ;
$return_my_deposit_string = (string)$return_my_deposit_int; 

$sql = "update `User` set `User_deposit_money` ='$return_my_deposit_string' where `User_email`='$MY_ID'";
$result = mysqli_query($conn, $sql);



$sql = "select * from `User` where `User_email` ='admin'"; /// 관리자의 보증금을 업데이트
$result = mysqli_query($conn,$sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);
$admin_deposit_money =$row['User_deposit_money'];


$admin_deposit_money_int = (int)$admin_deposit_money; 
$return_admin_deposit_int =$admin_deposit_money_int- $obbli_deposit_money_int ;
$return_admin_deposit_string = (string)$return_admin_deposit_int; 

$sql = "update `User` set `User_deposit_money` ='$return_admin_deposit_string' where `User_email`='admin'";
$result = mysqli_query($conn, $sql);


//// 노쇼인원의 데이터 업데이트 . 
$no_show_person_array = explode(",", $no_show_people);   
$response['list_number'] = sizeof($no_show_person_array);

for($o = 0; $o<sizeof($no_show_person_array)-1; $o++){
    // $response["no_show_people_$o"] = $no_show_person_array[$o];


    $sql = "select * from `User` where `User_email` ='$no_show_person_array[$o]'";
    $result = mysqli_query($conn,$sql);

    if($result){
    $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
    $User_no_show_data = $row['User_no_show'];
    $User_no_show_int = (int)$User_no_show_data; 
    $update_no_show_data = $User_no_show_int +1 ; 
    $update_no_show_data_string = (string)$update_no_show_data; 


    //노쇼 db에 넣어준다. 
    $sql = "select * from `No_show_data` where `No_show_user_id`='$no_show_person_array[$o]'and `Post_index` = '$get_Post_index'";
    $result = mysqli_query($conn, $sql);
    $rowCnt= mysqli_num_rows($result);

    if($rowCnt ===1){

    
    }else{
    $sql = "INSERT INTO `No_show_data`(`No_show_user_id`,`No_show_check_user`,`Post_index`) VALUES('$no_show_person_array[$o]','$MY_ID','$get_Post_index')";
    $result = mysqli_query($conn, $sql);
    }

    ////노쇼 데이터를 업데이트 해준다. 
    $sql = "update `User` set `User_no_show` ='$update_no_show_data_string' where `User_email`='$no_show_person_array[$o]'";
    $result = mysqli_query($conn, $sql);
    
    $response["result"] = true;
                ///후기 작성을 위해 데이터를 넣어줌 . 
            $sql = "select * from `write_post_for_user` where `User_id`='$no_show_person_array[$o]'and `Post_index` = '$get_Post_index'";
            $result = mysqli_query($conn, $sql);
            $rowCnt= mysqli_num_rows($result);

            if($rowCnt ===1){


            }else{
                $sql = "INSERT INTO `write_post_for_user`(`User_id`,`Post_index`) VALUES('$no_show_person_array[$o]','$get_Post_index')";
                $result = mysqli_query($conn, $sql);
            }
    }else{
        $response["result"] = false;
    }

}
///END FOR문 


//나중에 후기를 작성할 수 있도록 DB에 데이터 넣어줌 
$sql = "select * from `write_post_for_user` where `User_id`='$MY_ID'and `Post_index` = '$get_Post_index'";
$result = mysqli_query($conn, $sql);
$rowCnt= mysqli_num_rows($result);

if($rowCnt ===1){


}else{
$sql = "INSERT INTO `write_post_for_user`(`User_id`,`Post_index`) VALUES('$MY_ID','$get_Post_index')";
$result = mysqli_query($conn, $sql);
}



echo json_encode($response);
mysqli_close($conn);
?>
