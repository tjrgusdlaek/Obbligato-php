<?php
include "Mysql_connection.php";

$get_Post_index =$_POST['get_Post_index'];
$get_Writer =$_POST['get_Writer'];

$response =array();

$sql = "select * from `Obbligato_post` where id ='$get_Post_index' and Writer ='$get_Writer'";
$result = mysqli_query($conn,$sql);


$rowCnt= mysqli_num_rows($result);

if($result){
for($i=0;$i<$rowCnt;$i++){
    $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
    $response[$i]= $row;}
    echo json_encode($response); 


}else{
    echo "서버에서 보내지 못하였습니다";
}
?>