<?php

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'name' and 'msg' are set and not empty
    if (isset($_POST['name']) && isset($_POST['cmt']) && !empty($_POST['name']) && !empty($_POST['cmt'])) {
        $name = $_POST['name'];
        $cmt = $_POST['cmt'];

        $qry = $conn->prepare("INSERT INTO msg (name, cmt) VALUES (?, ?)");
        $qry->bind_param("ss", $name, $cmt);

        if ($qry->execute()) {
            echo 1;
        } else {
            echo 0;
        }

        $qry->close();
    } else {
        echo "Please fill in both name and message fields.";
    }
} else {
    echo "Invalid request method. This page should be accessed through a form submission.";
}

$conn->close();

//     include 'config.php';
 
//     $name = $_POST['name'];
//     $cmt = $_POST['cmt'];
     
//     $sql = "INSERT INTO msg (name, cmt) VALUES ('$name', '$cmt')";
//     $result = mysqli_query($conn, $sql);
 
//     if ($result) {
//         echo 1;
//     }else {
//         echo 0;
//     }
// ?>