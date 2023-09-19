<?php

error_reporting(0);

header('Access-Control_Allow_Origin:*');
header('Content_type:application/json');
header('Access-Control_Allow_Metthod:GET');
header('Access-Control_Allow_Header:Content-Type,Access_Control');
header('Access-Control_Allow_Headers:Content-Type,Access_Control_Allow_Headers,Authorization,X-Request_with');

include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == 'POST') {

    $inputData = json_decode(file_get_contents("php://input"), true);
    if (empty($inputData)) {

        $storeChat = storeChat($_POST);
    } else {
        $storeChat = storeChat($inputData);
    }
    echo $storeChat;
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . 'method not allowed',
    ];
    header('HTTp/1.0 405 method not allowed');
    echo  json_encode($data);
}
