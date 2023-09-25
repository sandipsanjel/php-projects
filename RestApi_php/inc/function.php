<?php
require '../inc/dbcon.php';

function error422($message)
{
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header("HTTP/1.0 422 unprocessable Entity");
    echo  json_encode($data);
    exit();
}
function storeChat($inputchat)
{
    global $conn;

    $queries = mysqli_real_escape_string($conn, $inputchat['queries']); //what ever data is passing from post method inputchat is passing to database 
    $replies = mysqli_real_escape_string($conn, $inputchat['replies']);

    if (empty(trim($queries))) {

        return error422('Enter your queries');
    } elseif (empty(trim($replies))) {

        return error422('Enter your replies'); //422 is input validation
    } else {
        $query = "INSERT INTO chat (queries,replies) VALUES ('$queries','$replies')"; //to store the data in db 
        $result = mysqli_query($conn, $query);

        if ($result) {
            $data = [
                'status' => 201, //201 smt is created or inserted 
                'message' => 'Chat Added to db successfully',
            ];
            header('HTTP/1.1 201 Created');
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal server Error',
            ];
            header("HTTP/1.1 500 Internal server Error");
            return json_encode($data);
        }
    }
}



function getChatList()
{
    global $conn;
    $query = "SELECT *FROM Chat";
    $query_run = mysqli_query($conn, $query);


    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            $data = [
                'status ' => 200,
                'meaaage' => 'users data fetched seccessfully',
                'data' => $res,
            ];
        } else
            $data = [
                'status' => 400,
                'message' => 'no chat ',
            ];
        header("http/1.0 400 internal server error");
        return  json_encode($data);
    } else {
        $data = [
            'status' => 500,
            'message' => 'internal sever error',
        ];
        header("http/1.0 400 internal server error");
        return  json_encode($data);
    }
}
function deleteChat($chatparameter)
{
    global $conn;
    if (!isset($chatparameter['id'])) {
        return error422('chat is not found in url');
    } elseif ($chatparameter['id'] == null) {
        return error422('Enter the chat id');
    }
    $chatId = mysqli_real_escape_string($conn, $chatparameter['id']);
    $query = "DELETE FROM chat WHERE id='$chatId' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = [
            'status' => 200, //201 smt is created or inserted 
            'message' => 'Chat deleted successfully',
        ];
        header('HTTP/1.1 200 Deleted');
        return json_encode($data);
    } else {
        $data = [
            'status' => 400,
            'message' => 'chat not found',
        ];
        header("HTTP/1.1 400 not found");
        return json_encode($data);
    }
}

function updatechat($inputchat, $chatparams)
{
    global $conn;
//input validation 
    if (!isset($chatparams['id'])) {
        return error422('chat id not found in url');
    } elseif ($chatparams['id']==null) {
        return error422('Enter your chat id');
    }
    $chatId = mysqli_real_escape_string($conn, $inputchat['id']); //data sanitization to prevent sql injection
    $queries = mysqli_real_escape_string($conn, $inputchat['queries']); //what ever data is passing from post method inputchat is passing to database 
    $replies = mysqli_real_escape_string($conn, $inputchat['replies']);

    if (empty(trim($queries))) { //to check if queries are empty or not after white sapce trim

        return error422('Enter your queries');
    } elseif (empty(trim($replies))) {

        return error422('Enter your replies'); //422 is input validation
    } else {
        $query = "UPDATE chat  SET queries='$queries',replies='$replies'  WHERE id='$chatId' LIMIT 1";//to update the data in db  it insures that only 1 data update at a time
        $result = mysqli_query($conn, $query);

        if ($result) {
            $data = [
                'status' => 200, //201 smt is created or inserted 
                'message' => 'Chat Updated to db successfully',
            ];
            header('HTTP/1.1 200 Updated');
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal server Error',
            ];
            header("HTTP/1.1 500 Internal server Error");
            return json_encode($data);
        }
    }
}
