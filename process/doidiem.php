<?php
require_once("../lib/conf.php");
if (isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];
    $sql = "SELECT * FROM students WHERE student_id = $student_id";
    $student = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    if ($student['diem'] < 100) {

        print_r(json_encode([
            'status' => 'error',
            'msg' => 'Điểm của bạn không đủ'
        ]));
        return;
    } else {
        $time = date('Y-m-d H:i:s');
        $sql = "INSERT INTO gift (student_id,created_at) VALUES ($student_id,'$time')";
        mysqli_query($conn, $sql);
        $sql = "UPDATE students SET diem = diem - 200";
        mysqli_query($conn, $sql);
        print_r(json_encode([
            'status' => 'success',
            'msg' => 'Đổi thành công !'
        ]));
        return;
    }
}
