<?php
session_start();
require_once("lib/conf.php");
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
require_once("include/header.php");



?>
<main>
    <section>
        <h2>Kết quả tìm kiếm: <span style="color: red"><?= count($data) ?></span> kết quả</h2>
        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 1) {
                echo '<h3 class="message-success">' . $messageSuccess . '</h3>';
            } else {
                echo '<h3 class="message-error">' . $messageError . '</h3>';
            }
        }
        ?>
        <form action="search.php" method="POST" s>
            <label for="search">Tìm kiếm sách:</label>
            <input type="text" id="search" name="search">
            <button type="submit">Tìm kiếm</button>
        </form>

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
<?php require_once("include/footer.php") ?>