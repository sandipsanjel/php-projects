<?php
$conn=mysqli_connect("localhost","root","","chatbot")
or die("databse error");

// getting message through ajax
$getMesg=mysqli_real_escape_string($conn, $_POST['text']);

$check_data="SELECT replies FROM chat WHERE queries LIKE '%getMesg'";
$run_query=mysqli_query($conn, $check_data)or die ("Error");

?>


