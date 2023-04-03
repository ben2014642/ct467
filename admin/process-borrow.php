<?php
require_once("../lib/conf.php");
if (isset($_POST['type'])) {
    $type = $_POST['type'];
}

switch ($type) {
    case 'update':
        $borrow_id = $_POST['borrow_id'];
        $book_id = $_POST['book_id'];
        $borrow_date = $_POST['borrow_date'];
        $return_date = $_POST['return_date'];
        $status = $_POST['status'];

        $sql = "UPDATE borrows SET `book_id` = $book_id,`borrow_date` = '$borrow_date',`return_date` = '$return_date',`status` = $status WHERE `borrow_id` = $borrow_id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            print_r(json_encode([
                'status' => 'success',
                'msg' => 'Cập nhật thông tin thành công !'
            ]));
        } else {
            print_r(json_encode([
                'status' => 'error',
                'msg' => 'Cập nhật thông tin thất bại !'
            ]));
        }
        break;
    case 'delete':
        $borrow_id = $_POST['borrow_id'];
        $sql = "DELETE FROM borrows WHERE borrow_id = $borrow_id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            print_r(json_encode([
                'status' => 'success',
                'msg' => 'Xóa dữ liệu thành công !'
            ]));
        } else {
            print_r(json_encode([
                'status' => 'error',
                'msg' => 'Xóa dữ liệu thất bại !'
            ]));
        }
        break;
    case 'add':
        $book_id = $_POST['book_id'];
        $student_id = $_POST['student_id'];
        $borrow_date = $_POST['borrow_date'];
        $return_date = $_POST['return_date'];
        $status = $_POST['status'];

        try {
            $sql = "INSERT INTO borrows (student_id,book_id,borrow_date,return_date,status) VALUES($student_id,$book_id,'$borrow_date','$return_date',$status)";
            $result = mysqli_query($conn, $sql);
            print_r(json_encode([
                'status' => 'success',
                'msg' => 'Thêm dữ liệu thành công !'
            ]));
        } catch (Exception $e) {
            print_r(json_encode([
                'status' => 'error',
                'msg' => $e->getMessage()
            ]));
        }
        // if ($result) {
        //     print_r(json_encode([
        //         'status' => 'success',
        //         'msg' => 'Thêm dữ liệu thành công !'
        //     ]));
        // } else {
        //     print_r(json_encode([
        //         'status' => 'error',
        //         'msg' => 'Thêm dữ liệu thất bại !'
        //     ]));
        // }
        break;
    default:
        # code...
        break;
}
