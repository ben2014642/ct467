<?php
$conn = mysqli_connect("localhost",'root','','muonsach');
mysqli_set_charset($conn,"utf8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
 }

?>
