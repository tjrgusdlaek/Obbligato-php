<?php

include "Mysql_connection.php";


$response= array(); //빈 배열 생성
$response["result"] = false;


$Category= $_POST['Category'];


if($Category ==='개인'){


    $Receiver= $_POST['Receiver'];
    $Sender= $_POST['Sender'];
    $Out_time= $_POST['Out_time'];
    $Host= $_POST['Host'];
    // $User_token= $_POST['User_token'];
    $Receiver_name= $_POST['Receiver_name'];
    $Receiver_profile_image= $_POST['Receiver_profile_image'];
    $Sender_name= $_POST['Sender_name'];
    $Sender_profile_image= $_POST['Sender_profile_image'];
    $Sender_token= $_POST['Sender_token'];
    $Receiver_token= $_POST['Receiver_token'];

    


$sql = "select * from `Chatting_room` where  (`Sender`='$Sender' and `Receiver` ='$Receiver') or (`Sender`='$Receiver' and `Receiver` ='$Sender')";
$result=mysqli_query($conn, $sql);
$rowCnt= mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);


if($rowCnt == 1){
    $response["result"] =true; 
    $response["Chatting_index"] =$row['id'];
    $response["Out_time"] =$row['Out_time'];
    $response["Host"] =$row['Host'];
    $response["save"] ="방이 이미 있습니다.";
    echo json_encode($response); 
    return;

}else{

    // $sql = "INSERT INTO `Chatting_room`(`Sender`,`Receiver`,`Title`) VALUES('$Sender','$Receiver','$Title')";
    
    $sql = "INSERT INTO `Chatting_room`(`Sender`,`Receiver`,`Category`,`Out_time`,`Host`,`Receiver_name`,`Receiver_image`,`Sender_image`,`Sender_name`,`Receiver_token`,`Sender_token`) 
    VALUES('$Sender','$Receiver','$Category','$Out_time','$Host','$Receiver_name','$Receiver_profile_image','$Sender_profile_image','$Sender_name','$Receiver_token','$Sender_token')";
    $result = mysqli_query($conn, $sql);

    if($result){

   

        $sql = "select * from `Chatting_room` where  (`Sender`='$Sender' and `Receiver` ='$Receiver') or (`Sender`='$Receiver' and `Receiver` ='$Sender')";
        $result=mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $Chatting_room_index = $row['id'];


        $sql = "INSERT INTO `Chatting`(`Receiver`,`Sender`,`Chatting_index`,`Message`) VALUES('join','$Receiver','$Chatting_room_index','join')";
        $result = mysqli_query($conn, $sql);

        $sql = "INSERT INTO `Chatting`(`Receiver`,`Sender`,`Chatting_index`,`Message`) VALUES('join','$Sender','$Chatting_room_index','join')";
        $result = mysqli_query($conn, $sql);


        $sql = "select * from `Chatting_room` where  (`Sender`='$Sender' and `Receiver` ='$Receiver') or (`Sender`='$Receiver' and `Receiver` ='$Sender')";
        $result=mysqli_query($conn, $sql);

        $response["Chatting_index"] =$row['id'];
        $response["result"] =true; 
        $response["Out_time"] =$row['Out_time'];
        $response["Host"] =$row['Host'];
        $response["save"] ="새로운 방이 생겼습니다.";
        echo json_encode($response); 
    
    }else{
        echo json_encode($response); 
    }
}

}else if($Category ==='그룹'){

    $Room_name= $_POST['Room_name'];
    $Participate_person= $_POST['Participate_person'];
    $Participate_person_token= $_POST['Participate_person_token'];
    $Participate_person_name= $_POST['Participate_person_name'];
    $Host= $_POST['Host'];
    $Out_time= $_POST['Out_time'];
    $Login_time= $_POST['Login_time'];
    $Obbligato_Index= $_POST['Obbligato_Index'];


    $Participate_person_array = explode(",", $Participate_person);   

  

    if($Obbligato_Index ===null){
        $Obbligato_Index ="";
    }else{

        $sql = "select * from `Chatting_room` where `Obbligato_index` = '$Obbligato_Index' ";
        $result=mysqli_query($conn, $sql);
        $rowCnt= mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        if($rowCnt ===1 ){
            echo json_encode($response); 
            return;
        }
    }
    



    
    $sql = "INSERT INTO `Chatting_room` (`Participate_person`,`Room_name`,`Category`,`Participate_person_token`,`Host`,`Participate_person_name`,`Out_time`,`Login_time`,`Obbligato_index`) 
    VALUES('$Participate_person','$Room_name','$Category','$Participate_person_token','$Host','$Participate_person_name','$Out_time','$Login_time','$Obbligato_Index')";
    $result = mysqli_query($conn, $sql);
    $response["sql"] =$sql; 

    if($result){
        $sql = "select * from `Chatting_room` where `Room_name`='$Room_name' and `Participate_person` ='$Participate_person'";
        $result=mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if($result){

   
        $Chatting_room_index = $row['id'];     

        for($m=0; $m<sizeof($Participate_person_array)-1; $m ++){
        $sql = "INSERT INTO `Chatting`(`Receiver`,`Sender`,`Chatting_index`,`Message`) VALUES('join','$Participate_person_array[$m]','$Chatting_room_index','join')";
        $result = mysqli_query($conn, $sql);
        }


        $sql = "select * from `Chatting_room` where `Room_name`='$Room_name' and `Participate_person` ='$Participate_person'";
        $result=mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

            $response["result"] =true; 
            $response["Chatting_index"] =$row['id'];
            $response["Participate_person"] =$row['Participate_person'];
            $response["Participate_person_token"] =$row['Participate_person_token'];
            $response["Host"] =$row['Host'];
            $response["Participate_person_name"] =$row['Participate_person_name'];
            $response["Room_name"] =$row['Room_name'];
            $response["Out_time"] =$row['Out_time'];


            $response["save"] ="새로운 방이 생겼습니다.";
    
    
            echo json_encode($response); 

        }else{
            echo json_encode($response); 
        
        }

    
    }else{
        echo json_encode($response); 
    
    }
}
mysqli_close($conn);
?>