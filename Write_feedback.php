<?php
include "Mysql_connection.php";


$get_Email= $_POST['get_Email'];
$post_index= $_POST['post_index'];

$response =array();


$User_array =array();  // 유저를 담기위한 어레이
$User_data_array = array(); //유저 데이터를 보내기위한 담기위한 어레이리스트 

//지원자들을 담아준다.
    $sql = "select `Applier` from `Final_contract` where `Post_index` ='$post_index' and `Status` = '1' group by `Applier`";
    $result = mysqli_query($conn,$sql);
    $rowCnt= mysqli_num_rows($result);
 

    for($i=0;$i<$rowCnt;$i++){
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        // $Applier_email_array = array(
        //     "User_email" => $row['Applier']
        // );
        array_push($User_array,$row['Applier']);
    }
      
//작성자를 담아준다. 작성자는 한명이므로 그룹 by를 해준다. 
    $sql = "select `Writer` from `Final_contract` where `Post_index` ='$post_index' and `Status` = '1' group by `Writer`";
    $result = mysqli_query($conn,$sql);
    $rowCnt= mysqli_num_rows($result);
 

    for($j=0;$j<$rowCnt;$j++){
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        // $Writer_email_array = array(
        //     "User_email" => $row['Writer']
        // );
        array_push($User_array,$row['Writer']);
    }




    


    for($o=0;$o<sizeof($User_array);$o++){
        $sql = "select * from `User` where  `User_email` ='$User_array[$o]' ";
        $result = mysqli_query($conn,$sql);
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        $User_list_array = array(
            "User_email" => $row['User_email'],
            "User_name" => $row['User_name'],
            "User_instrument" => $row['User_instrument'],
            "User_college" => $row['User_college'],
            "User_profile_image" => $row['User_profile_image']

            
            
        );
        array_push($User_data_array,$User_list_array);
    }
      




    $response['User_data_array'] = $User_data_array; 

    echo json_encode($response);


    mysqli_close($conn);

?>