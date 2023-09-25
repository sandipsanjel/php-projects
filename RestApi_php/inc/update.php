<?php

error_reporting(0);

header('Access-Control_Allow_Origin:*');
header('Content_type:application/json');
header('Access-Control_Allow_Metthod:PUT');
// header('Access-Control_Allow_Header:Content-Type,Access_Control');
header('Access-Control_Allow_Headers:Content-Type,Access_Control_Allow_Headers,Authorization,X-Request_with');

include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == 'PUT') {

    $inputData = json_decode(file_get_contents("php://input"), true); // reads the raw JSON data from the request body. and decodes the raw json data into into associative array
    if (empty($inputData)) {

        $updateChat = updateChat($_POST, $_GET); //to pass the id we added get method  for the form table 
    } else {
        $updateChat = updateChat($inputData, $_GET); //this id for the raw data /json data 
    }
    echo  $updateChat;
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . 'Method not allowed',
    ];
    header('HTTp/1.0 405 method not allowed');
    echo  json_encode($data);
}
