<?php 
header('Access-Control_Allow_Origin:*');
header('Content_type:application/json');
header('Access-Control_Allow_Metthod:GET');
header('Access-Control_Allow_Header:Content-Type,Access_Control');
header('Access-Control_Allow_Headers:Content-Type,Access_Control_Allow_Headers,Authorization,X-Request_with');

include('function.php');

$requestMethod =$_SERVER["REQUEST_METHOD"];
if ($requestMethod=="GET"){

    $chatList = getChatList();
    echo $chatList;
}
else {
    $data=[
        'status'=>405,
        'message'=>$requestMethod .'method not allowed',
    ];
header('HTTp/1.0 405 method not allowed');
echo  json_encode($data);

}

?>