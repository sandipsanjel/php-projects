<?php 
require '../inc/dbcon.php';
function getChatList(){
    global $conn;
    $query ="SELECT *FROM chat";
    $query_run = mysqli_query($conn, $query);


if ($query_run){
    if (mysqli_num_rows($query_run) >0){
$res=mysqli_fetch_all($query_run ,MYSQLI_ASSOC);
$data=[
    'status '=>200,
    'meaaage'=>'users data fetched seccessfully',
    'data'=>$res,
];
    }else 
    $data = [
        'status'=> 400,
        'message'=>'no chat ',
    ];
    header("http/1.0 400 internal server error");
   return  json_encode($data);
}

else
{
    $data = [
        'status'=> 500,
        'message'=>'internal sever error',
    ];
    header("http/1.0 400 internal server error");
  return  json_encode($data);
}
}
?>