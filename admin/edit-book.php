<?php
require_once("../lib/conf.php");
if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
}
$sql = "SELECT * from books
        WHERE book_id = $book_id";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($query);


?>
<?php require_once("header.php") ?>
<div class="edit-borrow-form">
    <h2>Chỉnh sửa thông tin mượn sách</h2>
    <form id="formUpdateBook" method="POST">
        <div class="form-group">
            <input type="text" id="book_id" hidden value="<?= $data['book_id'] ?>" name="book_id">
        </div>
        <div class="form-group">
            <label for="book_name">Book name:</label>
            <input type="text" id="book_name" value="<?= $data['title'] ?>"  name="title" required>
        </div>
        <div class="form-group">
            <label for="thumbnail">Thumbnail:</label>
            <input type="text" id="thumbnail" value="<?= $data['thumbnail'] ?>" name="thumbnail" required>
        </div>
        <div class="form-group">
            <label for="quantity">Remain:</label>
            <input type="text" id="quantity" value="<?= $data['quantity'] ?>" name="quantity" required>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" id="author" value="<?= $data['author'] ?>" name="author" required>
        </div>
        <div class="form-group">
            <label for="publisher">Publisher</label>
            <input type="text" id="publisher" value="<?= $data['publisher'] ?>" name="publisher" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status">
                    <?php
                    if ($data['status']) {
                        echo
                        '<option value="0">Draft</option>
                            <option selected value="1">Public</option>';
                    } else {
                        echo '
                            <option selected value="0">Draft</option>
                            <option value="1">Public</option>
                            ';
                    }
                    ?>
                </select>
        </div>
        <button name="updateBook" type="submit">Lưu</button>
    </form>
    <?php require_once("footer.php") ?>
    <script>
        $("#formUpdateBook").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "process-Book.php",
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