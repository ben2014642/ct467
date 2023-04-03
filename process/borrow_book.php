<?php

require_once("../lib/conf.php");
$message = '';
$status = 0;
// if (isset($_POST['submitBorrow'])) {

// Bắt đầu TRANSACTION
mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);
try {

    $book_id = $_POST['book-id'];
    $student_id = $_POST['student-id'];
    $borrow_date = $_POST['borrow-date'];
    $return_date = $_POST['return-date'];
    // Cập nhật thông tin mượn trả sách
    $sql_update_borrow = "INSERT INTO borrows (student_id, book_id, borrow_date, return_date) VALUES ($student_id, $book_id, '$borrow_date','$return_date')";
    // echo $sql_update_borrow;
    $result = mysqli_query($conn, $sql_update_borrow);
    $message = "Borrowing successful!";
    $status = 1;

    // Kết thúc TRANSACTION và lưu các thay đổi vào cơ sở dữ liệu
    mysqli_commit($conn);
} catch (Exception $e) {
    $message = "Error: " . $e->getMessage();
    // Nếu có lỗi xảy ra, hoàn tác TRANSACTION
    mysqli_rollback($conn);
}
$arr = [
    'msg' => $message,
    'status' => $status
];
print_r(json_encode($arr));
// header("Location: /index.php?status='.$status.'&msg=".$message);
// Đóng kết nối
mysqli_close($conn);
// }
