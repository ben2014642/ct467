<?php
require_once("../lib/conf.php");
if (isset($_POST['type'])) {
    $type = $_POST['type'];
}

switch ($type) {
    case 'update':
        $donate_id = $_POST['donate_id'];
        $created_at = $_POST['created_at'];
        $donate_quantity = $_POST['donate_quantity'];

        $sqlUpdateDonate = "UPDATE donate_books SET `created_at` = '$created_at',`quantity` = $donate_quantity WHERE `donate_id` = $donate_id";

        $resultUpdateDonate = mysqli_query($conn, $sqlUpdateDonate);

        if ($resultUpdateDonate) {
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
        $donate_id = $_POST['donate_id'];
        $sql = "DELETE FROM donate_books WHERE donate_id = $donate_id";
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
        mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);

        try {
            $stmt = mysqli_prepare($conn, "CALL add_book(?,?,?,?,?,?,?,?)");
            mysqli_stmt_bind_param($stmt, "ssssissi", $title, $author, $publisher, $publication_date, $quantity, $thumbnail, $created_at, $status);

            $title = $_POST['book_name'];
            $author = $_POST['author'];
            $publisher = $_POST['publisher'];
            $publication_date = $_POST['publication_date'];
            $quantity = $_POST['quantity'];
            $thumbnail = $_POST['thumbnail'];
            $created_at = date('Y-m-d H:i:s');
            $status = $_POST['status'];

            $result = mysqli_stmt_execute($stmt);

            $query = mysqli_query($conn, "SELECT * FROM books order by book_id DESC LIMIT 1");
            $book = mysqli_fetch_assoc($query);
            $book_id = $book['book_id'];
            $student_id = $_POST['student_id'];
            $quantity = $book['quantity'];
            $created_at = date('Y-m-d H:i:s');
            $sql = "INSERT INTO donate_books (book_id,student_id,quantity,created_at) VALUES ($book_id,$student_id,$quantity,'$created_at')";

            mysqli_query($conn, $sql);
            mysqli_commit($conn);
            print_r(json_encode([
                'status' => 'success',
                'msg' => 'Thêm dữ liệu thành công !'
            ]));
        } catch (Exception $e) {
            mysqli_rollback($conn);

            print_r(json_encode([
                'status' => 'error',
                'msg' => $book
            ]));
        }
        mysqli_close($conn);
        break;
    default:
        # code...
        break;
}
