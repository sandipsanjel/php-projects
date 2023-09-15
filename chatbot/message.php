<?php
$conn=mysqli_connect("localhost","root","","chatbot")
or die("databse error");

//getting message through ajax
$getMesg=mysqli_real_escape_string($conn, $_POST['text']);
?>


