<?php
include "Mysql_connection.php";


$get_Email= $_POST['get_Email'];
$My_instrument= $_POST['My_instrument'];


$response =array();
$array =array();   //스플릿을 하기위한 arraylist 1개 
$array2 =array();  //스플릿을 하기위한 arraylist 

$sql = "select * from `User` where `User_email` ='$get_Email'";
$result = mysqli_query($conn,$sql);
$row= mysqli_fetch_array($result,MYSQLI_ASSOC);
$get_Region = $row["User_region"];
// $get_instrument = $row['User_set_instrument'];


// $get_instrument = "첼로 3,바이올린 2, 콘트라베이스 5,";
// if(strpos($My_instrument, $get_instrument) !== false){
//     $response["contains"]= "있음";
//     $response["contains2"]= $get_instrument;
//     $response["contains3"]= $My_instrument;
//     echo json_encode($response); 
//     return;
// } 

if($get_Region ==="null" || $get_Region ==='설정안함' ||$get_Region ===""){

    $sql = "select * from `Obbligato_post`";
    $result = mysqli_query($conn,$sql);
    $rowCnt= mysqli_num_rows($result);
    if($result){
            for($i=0;$i<$rowCnt;$i++){
                $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
                $response[$i]= $row;
            }
            echo json_encode($response); 
    }else{
        echo "서버에서 보내지 못하였습니다";
    }

}else {

    $sql = "select * from `Obbligato_post` where `Region` ='$get_Region'";
    $result = mysqli_query($conn,$sql);
    $rowCnt= mysqli_num_rows($result);
    if($result){

            for($i=0;$i<$rowCnt;$i++){
                $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
                $response[$i]= $row;
            }
        
            echo json_encode($response);
    }else{
        echo "서버에서 보내지 못하였습니다";
    }


}

?>



<!-- if($My_instrument !=="null"){
            // if($rowCnt >=1){
                for($i=0;$i<$rowCnt;$i++){
                    $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
                    $need_instrument = $row['Need_instrument'];
    
                    $array = explode("," ,$need_instrument);
                    for($j =0; $j<count($array); $j++){
                        $array2 = explode(" ",$array[$j]); 
                        // $response[$j] =$array2[0];
                        if($My_instrument === $array2[0]){
                            $response[$i]= $row;
                        }
                    }
                    
                    // for($k =0; $k<count($array2); $k++){
                    
                    //     $response[$k] =$array2[$k];
                    // }
                }
            // }else{


            // }
            echo json_encode($response); 
        }else{ -->