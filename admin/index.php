<?php
require_once("../lib/conf.php");
$sql = "SELECT * from books";
$query = mysqli_query($conn, $sql);
$data = [];
while ($row = mysqli_fetch_array($query, 1)) {
    $data[] = $row;
}
// print_r($data);
// die();
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
            <a href="add-book.php" class="btn btnSuccess">Thêm</a>
            <a href="export.php?page=infoBook" class="btn btnSuccess">Xuất Excel</a>
        </div>
        <h2>List Books</h2>
        <table>
            <thead>
                <tr>
                    <th>Book Name</th>
                    <th>Thumbnail</th>
                    <th>Remain</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $item) {
                    $status = '';
                    if ($item['status']) {
                        $status .=
                            '<button class="btn btnSuccess">Public</button>';
                    } 
                    else {
                        $status .=
                            '<button class="btn btnDanger">Draft</button>';
                    }
                    echo
                    '<tr>
                        <td>' . $item['title'] . '</td>
                        <td><img src="' . $item['thumbnail'] . '" style="width: 100px"></td>
                        <td>' . $item['quantity'] . '</td>
                        <td>' . $item['author'] . '</td>
                        <td>' . $item['publisher'] . '</td>
                        <td>'.$status.'</td>
                        <td>
                            <a class="btn btnEdit" href="edit-book.php?book_id=' . $item['book_id'] . '">EDIT<a>
                            <a type="submit" onclick="deleteBook(' . $item['book_id'] . ');" class="btn btnDelete" >DELETE</a>
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
    console.log($("#formDeleteBook"));

    function deleteBook(book_id) {
        if (!confirm("Bạn có chắc chắn muốn xóa ?")) {
            return;
        }
        $.ajax({
            type: "POST",
            url: "process-book.php",
            data: {
                book_id: book_id,
                type: 'delete'
            },
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

    }
</script>

</html>