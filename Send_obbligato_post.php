<?php
include "Mysql_connection.php";

$response =array();

$sql = "select * from `Obbligato_post`";
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