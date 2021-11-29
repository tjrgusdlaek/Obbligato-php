<?php
include "Mysql_connection.php";

$get_Post_index =$_POST['get_Post_index'];
$instrument =$_POST['instrument'];

$response =array();

$sql = "select * from `Final_contract` where Post_index ='$get_Post_index' and Apply_instrument ='$instrument'";
$result = mysqli_query($conn,$sql);


$rowCnt= mysqli_num_rows($result);

if($result){
for($i=0;$i<$rowCnt;$i++){
    $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
    $number= $row['Number'];
    $final_number += $number;
    

}
    $final_number_string = (string)$final_number; 
    $response['number'] =$final_number_string;
    echo json_encode($response); 


}else{
    echo "서버에서 보내지 못하였습니다";
}
?>