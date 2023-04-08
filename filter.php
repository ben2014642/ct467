<?php
session_start();
require_once("./lib/conf.php");

if (isset($_POST['filter'])) {
    $type = $_POST['filter'];
}

switch ($type) {
    case '1':
        $sql = "SELECT * FROM books ORDER BY created_at DESC";
        break;
    case '2':
        $sql = "SELECT * FROM books ORDER BY title ASC";
        break;
    case '3':
        $sql = "SELECT * FROM books ORDER BY title DESC";
        break;
    default:
        break;
}

$data = [];
$query = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($query, 1)) {
    $data[] = $row;
}

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
 
?>

<?php 
    require_once("include/header.php");
?>
    <main>
        <section>
            <?php
            if (isset($_GET['status'])) {
                if ($_GET['status'] == 1) {
                    echo '<h3 class="message-success">' . $messageSuccess . '</h3>';
                } else {
                    echo '<h3 class="message-error">' . $messageError . '</h3>';
                }
            }
            ?>
            <div class="search-filter">
                <form action="search.php" method="POST" s>
                    <label for="search">Tìm kiếm sách:</label>
                    <input type="text" id="search" name="search">
                    <button type="submit">Tìm kiếm</button>
                </form>
                <form action="filter.php" method="POST" s>
                    <!-- <label for="search">Lọc:</label> -->
                    <select name="filter" id="filter">
                        <option value="1">Mới cập nhật</option>
                        <option value="2">A-Z</option>
                        <option value="3">Z-A</option>
                    </select>
                    <button type="submit">Lọc</button>
                </form>
            </div>
        </section>
        <section>
            <ul class="book-list">
                <?php
                foreach ($data as $item) {
                    echo '
            <li class="list-item">
                <a class="title-book" href="abc">' . $item['title'] . '</a>
                <p><span class="label">Author</span>: ' . $item['author'] . '</p>
                <p><span class="label">Publisher</span>: ' . $item['publisher'] . '</p>
                <p><span class="label">Remain</span>: ' . $item['quantity'] . '</p>
                <img src="' . $item['thumbnail'] . '" style="width: 100px">
                <a href="formborrow.php?book_id=' . $item['book_id'] . '" class="btnMuonSach">Mượn Sách</a>
            </li>';
                }

                ?>
            </ul>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Thư viện trường Đại Học</p>
    </footer>
</body>

</html>