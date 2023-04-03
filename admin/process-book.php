<?php
require_once("../lib/conf.php");
if (isset($_POST['type'])) {
    $type = $_POST['type'];
}

switch ($type) {
    case 'update':
        $book_id = $_POST['book_id'];
        $title = $_POST['title'];
        $thumbnail = $_POST['thumbnail'];
        $quantity = $_POST['quantity'];
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $status = $_POST['status'];

        $sql = "UPDATE books SET `book_id` = $book_id,`title` = '$title',`thumbnail` = '$thumbnail',`quantity` = $quantity,`author` = '$author',`publisher` = '$publisher',`status` = $status WHERE `book_id` = $book_id";
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
        $book_id = $_POST['book_id'];
        $sql = "DELETE FROM books WHERE book_id = $book_id";
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


        $stmt = mysqli_prepare($conn, "CALL add_book(?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssssissi", $title, $author, $publisher, $publication_date,$quantity,$thumbnail,$created_at,$status);


        $created_at = date('Y-m-d H:i:s');
        $title = $_POST['title'];
        $thumbnail = $_POST['thumbnail'];
        $quantity = $_POST['quantity'];
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $status = $_POST['status'];
        $publication_date = $_POST['publication_date'];


        $result = mysqli_stmt_execute($stmt);
        if ($result) {
            print_r(json_encode([
                'status' => 'success',
                'msg' => 'Thêm dữ liệu thành công !'
            ]));
        } else {
            print_r(json_encode([
                'status' => 'error',
                'msg' => 'Thêm dữ liệu thất bại !'
            ]));
        }
        break;
    default:
        # code...
        break;
}
