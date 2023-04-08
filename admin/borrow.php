<?php
require_once("../lib/conf.php");
$sql = "SELECT borrows.status,borrows.borrow_id,books.title,students.name,borrows.borrow_date,borrows.return_date from borrows
        JOIN books ON borrows.book_id = books.book_id
        JOIN students ON borrows.student_id = students.student_id";
$query = mysqli_query($conn, $sql);
$data = [];
while ($row = mysqli_fetch_array($query, 1)) {
    $data[] = $row;
}

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
            <a href="add-borrow.php" class="btn btnSuccess">Thêm</a>
            <a href="export.php?page=borrowBook" class="btn btnSuccess">Xuất Excel</a>
        </div>
        <h2>Borrow Books</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Book Name</th>
                    <th>Borrower Name</th>
                    <th>Borrow Date</th>
                    <th>Return Date</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $item) {
                    $status = '';
                    if ($item['status']) {
                        $status .=
                            '<button class="btn btnSuccess">Đã Mượn</button>';
                    } else if (!$item['status']) {
                        $status .=
                            '<button class="btn btnDanger">Chờ</button>';
                    } else {
                        $status .=
                            '<button class="btn btnInfo">Đã trả</button>';
                    }
                    echo
                    '<tr>
                        <td>' . $item['borrow_id'] . '</td>
                        <td>' . $item['title'] . '</td>
                        <td>' . $item['name'] . '</td>
                        <td>' . $item['borrow_date'] . '</td>
                        <td>' . $item['return_date'] . '</td>
                        <td>
                            <a class="btn btnEdit" href="edit-borrow.php?borrow_id=' . $item['borrow_id'] . '">EDIT<a>
                            <form action="" id="formDeleteBorrow" method="POST">
                                <input type="text" name="borrow_id" value="' . $item['borrow_id'] . '" hidden id="">
                                <button type="submit" class="btn btnDelete" >DELETE</button>
                            </form>
                        </td>
                        <td>' . $status . '</td>
                    </tr>';
                }
                ?>

            </tbody>
        </table>
    </div>

</div>

<?php require_once("footer.php") ?>