<?php
require_once("../lib/conf.php");

$stmt = mysqli_prepare($conn, "CALL add_student(?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $password, $phone);


$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['fullName'];
$phone = $_POST['phone'];


$result = mysqli_stmt_execute($stmt);
if ($result) {
    echo json_encode([
        'status' => 'success'
    ]);
} else {
    echo json_encode([
        'status' => 'error'
    ]);
}
mysqli_close($conn);


?>