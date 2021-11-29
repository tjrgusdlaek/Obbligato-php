<?php
include "Mysql_connection.php";


$writer_id= $_POST['writer_id'];
$MYID= $_POST['MYID'];


$response =array();
$response["result"] = false;
$feedback_array = array();

$sql = "select * from `Post_for_user` where `User_id`='$writer_id'";
$result = mysqli_query($conn,$sql);
$rowCnt= mysqli_num_rows($result);



        for($i=0;$i<$rowCnt;$i++){
            $row= mysqli_fetch_array($result,MYSQLI_ASSOC);

            $feedback = array(
                "Writer" => $row['Writer'],
                "Message" => $row['Message'],
                "Date" => $row['Date'],
                "User_image" => $row['User_image'],
                "id" => $row['id']
            );
            array_push($feedback_array,$feedback);
        }


        $check_array =array();

        $sql = "select * from `write_post_for_user` where   `User_id` = '$writer_id'";
        $result = mysqli_query($conn,$sql);
        $rowCnt= mysqli_num_rows($result);

        for($j=0;$j<$rowCnt;$j++){
            $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
            $check_array[$j] = $row['Post_index'];
        }
       
        for($o=0; $o<sizeof($check_array); $o++){
            $sql = "select * from `write_post_for_user` where `User_id` = '$MYID' and `Post_index` = '$check_array[$o]'";
            $result = mysqli_query($conn,$sql);
            $rowCnt= mysqli_num_rows($result);
            $response['sql'] = $sql;
        
                if($rowCnt >=1){
                    $response["result"] = "true";
                    // break;
                }else{
                    $response["result"] = "false";
                }
        }



        // $response['check_array'] = $check_array;
        $response['feedback'] = $feedback_array;
        echo json_encode($response); 
    mysqli_close($conn);
?>