<?php
require_once("../lib/conf.php");
if (isset($_GET['donate_id'])) {
    $donate_id = $_GET['donate_id'];
}
$sql = "SELECT *,donate_books.created_at as donate_day,donate_books.quantity as donate_quantity from donate_books
        JOIN books ON donate_books.book_id = books.book_id
        JOIN students ON donate_books.student_id = students.student_id
        WHERE donate_id = $donate_id";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($query);


?>
<?php require_once("header.php") ?>
<div class="edit-borrow-form">
    <h2>Chỉnh sửa thông tin sách được quyên góp</h2>
    <form id="formUpdateDonate" method="POST">
        <div class="form-group">
            <input type="text" id="donate_id" hidden value="<?= $data['donate_id'] ?>" name="donate_id">
        </div>
        <div class="form-group">
            <label for="book_name">Book name:</label>
            <input type="text" id="book_name" value="<?= $data['title'] ?>" disabled name="title" required>
        </div>
        <div class="form-group">
            <label for="quantity">Donate Name:</label>
            <input type="text" id="quantity" value="<?= $data['name'] ?>" disabled name="name" required>
        </div>
        <div class="form-group">
            <label for="donate_day">Donate Day</label>
            <input type="date" id="donate_day" value="<?= $data['donate_day'] ?>" name="created_at" required>
        </div>
        <div class="form-group">
            <label for="publisher">Quantity</label>
            <input type="text" name="donate_quantity" value="<?= $data['donate_quantity'] ?>" id="">
        </div>
        
        <button name="updateBook" type="submit">Lưu</button>
    </form>
    <?php require_once("footer.php") ?>
    <script>
        $("#formUpdateDonate").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "process-donate.php",
                data: $(this).serialize() + '&type=update' ,
                dataType: "json",
                success: function(response) {
                    if (response.status == 'success') {
                        toastr.success(response.msg, 'success!')
                        setTimeout(() => {
                            window.location.href = './';
                        }, 3000);
                    } else {
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