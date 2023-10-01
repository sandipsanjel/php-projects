<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "chatbot";

$conn = mysqli_connect($servername, $username, $password, $database);
if ($conn) {
    echo "connected";
}
