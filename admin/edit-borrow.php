<?php
require_once("../lib/conf.php");
if (isset($_GET['borrow_id'])) {
    $borrow_id = $_GET['borrow_id'];
}
$sql = "SELECT *,borrows.status as br_status from borrows
        JOIN books ON borrows.book_id = books.book_id
        JOIN students ON borrows.student_id = students.student_id WHERE borrows.borrow_id = $borrow_id";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($query);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Borrow</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body>
    <div class="edit-borrow-form">
        <h2>Chỉnh sửa thông tin mượn sách</h2>
        <form id="formUpdateBorrow" method="POST">
            <div class="form-group">
                <label for="borrow-id">ID phiếu mượn:</label>
                <input type="text" id="borrow-id" value="<?= $data['borrow_id'] ?>" readonly="true" name="borrow_id" required>
            </div>
            <div class="form-group">
                <label for="book-id">Mã sách:</label>
                <input type="text" id="book-id" value="<?= $data['book_id'] ?>" name="book_id" required>
            </div>
            <div class="form-group">
                <label for="book-id">Họ tên:</label>
                <input type="text" id="book-id" value="<?= $data['name'] ?>" disabled name="name" required>
            </div>
            <div class="form-group">
                <label for="borrow-date">Ngày mượn:</label>
                <input type="date" id="borrow-date" value="<?= $data['borrow_date'] ?>" name="borrow_date" required>
            </div>
            <div class="form-group">
                <label for="return-date">Ngày trả:</label>
                <input type="date" id="return-date" value="<?= $data['return_date'] ?>" name="return_date" required>
            </div>
            <div class="form-group">
                <label for="book-id">Trạng thái:</label>
                <select name="status" id="status">
                    <?php
                    if ($data['br_status']) {
                        echo
                        '<option value="0">Chờ</option>
                            <option selected value="1">Đã mượn</option>';
                    } else {
                        echo '123';
                        echo '
                            <option selected value="0">Chờ</option>
                            <option value="1">Đã mượn</option>
                            ';
                    }
                    ?>
                </select>
            </div>
            <button name="updateBorrow" type="submit">Lưu</button>
        </form>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $("#formUpdateBorrow").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "process-borrow.php",
            data: $(this).serialize()+'&type=update',
            dataType: "json",
            success: function(response) {
                if (response.status == 'success') {
                    toastr.success(response.msg, 'success!')
                    setTimeout(() => {
                        window.location.href = './';
                    }, 3000);
                } 
                else {
                    toastr.error(response.msg, 'error!')
                    setTimeout(() => {
                        window.location.href = './';
                    }, 3000);
                }
            }
        });
    })
</script>

</html>