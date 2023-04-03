<?php
session_start();
require_once("./lib/conf.php");
if (isset($_POST['search'])) {
    $keyword = $_POST['search'];
    $sql = "SELECT * FROM books WHERE title LIKE '%$keyword%'";
    $query = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_array($query, 1)) {
        $data[] = $row;
    }
}

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
// print_r($data);die;

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Chương trình quản lý thông tin sách, mượn trả sách của thư viện trường Đại Học</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
    <header>
        <h1>Thư viện trường Đại Học</h1>
        <nav>
            <ul>
                <li><a href="/">Trang chủ</a></li>
                <li><a href="#">Danh mục sách</a></li>
                <?php
                if (empty($user)) {
                    echo '
            <li><a href="login.php">Đăng nhập</a></li>
            <li><a href="register.php">Đăng ký</a></li>
            ';
                } else {
                    echo '<li>
            Xin chào, 
            <span style="color: #ff1111">' . $user['name'] . '</span>
            </li>';
                }
                ?>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Kết quả tìm kiếm: <span style="color: red"><?=count($data)?></span> kết quả</h2>
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
    <footer>
        <p>&copy; 2023 Thư viện trường Đại Học</p>
    </footer>
</body>

</html>