<?php
include "Mysql_connection.php";

$writer =$_POST['writer'];
$applier =$_POST['applier'];
$post_index =$_POST['post_index'];



$response =array();

$sql = "select * from `Final_contract` where `Post_index` ='$post_index' and `Writer` ='$writer' and `Applier` ='$applier'";
$result = mysqli_query($conn,$sql);


// $rowCnt= mysqli_num_rows($result);

if($result){
// for($i=0;$i<$rowCnt;$i++){
    $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
    $response["QRcord"]= $row['Qr_number'];
// }

    echo json_encode($response); 


}else{
    echo "서버에서 보내지 못하였습니다";
}
?>