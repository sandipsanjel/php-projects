<?php

error_reporting(0);
// PHP code are used to set HTTP response headers, particularly related to Cross-Origin Resource Sharing (CORS)
header('Access-Control_Allow_Origin:*');
header('Content_type:application/json');
header('Access-Control_Allow_Metthod:POST');
header('Access-Control_Allow_Header:Content-Type,Access_Control');
header('Access-Control_Allow_Headers:Content-Type,Access_Control_Allow_Headers,Authorization,X-Request_with');

include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == 'POST') {

    $inputData = json_decode(file_get_contents("php://input"), true); // reads the raw JSON data from the request body. and decodes the raw json data into into associative array
    if (empty($inputData)) {

        $storeChat = storeChat($_POST); //this method is for the form input data
    } else {
        $storeChat = storeChat($inputData); //this id for the raw data /json data 
    }
    echo $storeChat;
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . 'Method not allowed',
    ];
    header('HTTp/1.0 405 method not allowed');
    echo  json_encode($data);
}
