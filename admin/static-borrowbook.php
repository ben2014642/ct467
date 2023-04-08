<?php
require_once("../lib/conf.php");

if (isset($_POST['search'])) {
    $search = $_POST['search'];
} else {
    $search = '';
}
$sql = "SELECT borrows.book_id,books.title,COUNT(borrows.book_id) as count_borrow FROM borrows
JOIN books ON borrows.book_id = books.book_id WHERE (borrows.book_id) = '$search' OR (books.title) like '%$search%'
GROUP BY borrows.book_id,books.title";
$query = mysqli_query($conn, $sql);

$borrows = [];
while ($row = mysqli_fetch_array($query, 1)) {
    $borrows[] = $row;
}

?>
<?php require_once("header.php") ?>
<div class="content">
    
    <a href="javascript:history.back(1);" class="btn btnDanger">Quay lại</a>
    <div class="static-list">
        <form action="static-borrowbook.php" method="POST">
            <div class="">
                <label for="search">Search:</label>
                <input placeholder="" type="text" id="search" name="search">
                <button type="submit"><img style="width: 19px" src="../image/search-borrow.png" alt=""></button>
            </div>
        </form>
        <h2>Số Lượng Sách Đã Được Mượn</h2>
        <table style="width: 100%">
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Book Title</th>
                    <th>Borrow Count</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($borrows as $item) {
                    echo '
                        <tr>
                            <td>' . $item['book_id'] . '</td>
                            <td>' . $item['title'] . '</td>
                            <td>' . $item['count_borrow'] . '</td>
                        
                        </tr>';
                }
                ?>

            </tbody>
        </table>
    </div>
</div>
<?php require_once("footer.php") ?>