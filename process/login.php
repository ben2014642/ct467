<?php
session_start();
require_once("../lib/conf.php");

$email = $_POST['email'];
$password = $_POST['password'];
$sql = "SELECT * FROM students WHERE `email` = '$email' AND `password` = '$password'";
$query = mysqli_query($conn,$sql);

$data = mysqli_fetch_assoc($query);
if ($data) {
    $arr = [
        'student_id' => $data['student_id'],
        'name' => $data['name'],
        // 'diem' => $data['diem']
    ];
    $_SESSION['user'] = $arr;
    echo json_encode([
        'status' => 'success'
    ]);
} else {
    // echo json_encode([
    //     'status' => 'error'
    // ]);
    header('X-PHP-Response-Code: 500', true, 500);

}
mysqli_close($conn);


?>