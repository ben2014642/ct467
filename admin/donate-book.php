<?php
require_once("../lib/conf.php");

$sql = "SELECT *,donate_books.quantity as donate_quantity from donate_books
        JOIN books ON donate_books.book_id = books.book_id
        JOIN students ON donate_books.student_id = students.student_id";
$query = mysqli_query($conn, $sql);
$data = [];
while ($row = mysqli_fetch_array($query, 1)) {
    $data[] = $row;
}
// print_r($data);die();
?>
<?php require_once("header.php") ?>
<div class="content">
    <!-- <div class="borrow-form">
                <h2>Borrow a book</h2>
                <form action="borrow.php" method="post">
                    <div class="form-group">
                        <label for="book-name">Book Name</label>
                        <input type="text" id="book-name" name="book_name" required>
                    </div>
                    <div class="form-group">
                        <label for="borrower-name">Borrower Name</label>
                        <input type="text" id="borrower-name" name="borrower_name" required>
                    </div>
                    <div class="form-group">
                        <label for="borrow-date">Borrow Date</label>
                        <input type="date" id="borrow-date" name="borrow_date" required>
                    </div>
                    <button type="submit">Borrow</button>
                </form>
            </div> -->

    <div class="borrowed-books">
        <div class="">
            <a href="add-donate.php" class="btn btnSuccess">Thêm</a>
            <a href="" class="btn btnSuccess">In</a>
        </div>
        <h2>Donate Books</h2>
        <table>
            <thead>
                <tr>
                    <th>Book Name</th>
                    <th>Donate Name</th>
                    <th>Donate Day</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $item) {
                    echo
                    '<tr>
                        <td>' . $item['title'] . '</td>
                        <td>' . $item['name'] . '</td>
                        <td>' . $item['created_at'] . '</td>
                        <td>' . $item['donate_quantity'] . '</td>
                        <td>
                            <a class="btn btnEdit" href="edit-donate.php?donate_id=' . $item['donate_id'] . '">EDIT<a>
                                <a type="submit" onclick="deleteDonateBook(' . $item['donate_id'] . ')" class="btn btnDelete" >DELETE</a>
                        </td>
                        
                    </tr>';
                }
                ?>

            </tbody>
        </table>
    </div>

</div>
<?php require_once("footer.php") ?>

<script>
    function deleteDonateBook(donate_id) {
        if (!confirm("Bạn có chắc chắn muốn xóa ?")) {
            return;
        }
        $.ajax({
            type: "POST",
            url: "process-donate.php",
            data: {
                donate_id: donate_id,
                type: 'delete'
            },
            dataType: "json",
            success: function(response) {
                if (response.status == 'success') {
                    toastr.success(response.msg, 'success!')
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                } else {
                    toastr.error(response.msg, 'error!')
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                }
            }
        });

    }
</script>