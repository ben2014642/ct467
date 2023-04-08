<?php
require_once("../lib/conf.php");

$total_borrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_borrow FROM borrows"));

$total_book = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_book FROM books"));

$quantity_book = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(quantity) AS quantity_book FROM books"));

$total_student = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_student FROM students"));




$statics = [
    'total_borrow' => $total_borrow['total_borrow'],
    'total_book' => $total_book['total_book'],
    'total_student' => $total_student['total_student'],
    'quantity_book' => $quantity_book['quantity_book']
];

?>

<?php require_once("header.php") ?>
<div class="content">
    <div class="direct-link">
        <a href="static-borrowed.php" class="btn btnInfo">S.Viên Mượn Sách</a>
        <a href="static-borrowbook.php" class="btn btnDanger">Số Sách Đã Được Mượn</a>
        
    </div>
    <div class="static-list-2">
        <div class="static-item">
            <div class="static-head">
                <img class="static-icon" src="../image/book.png" alt="">
                <span>--Số loại sách có trong thư viện--</span>
            </div>
            <div class="static-body">
                <span>Số lượng:</span>
                <span><?= $statics['total_book'] ?></span>
            </div>
        </div>
        <div class="static-item">
            <div class="static-head">
                <img class="static-icon" src="../image/book-stack.png" alt="">
                <span>--Tổng số lượng sách có trong thư viện--</span>
            </div>
            <div class="static-body">
                <span>Số lượng:</span>
                <span><?= $statics['quantity_book'] ?></span>
            </div>
        </div>
        <div class="static-item">
            <div class="static-head">
                <img class="static-icon" src="../image/borrow_book.png" alt="">
                <span>--Số sách đã được mượn--</span>
            </div>
            <div class="static-body">
                <span>Số lượng:</span>
                <span><?= $statics['total_borrow'] ?></span>
            </div>
        </div>
        <div class="static-item">
            <div class="static-head">
                <img class="static-icon" src="../image/student.png" alt="">
                <span>--Số tài khoản trên hệ thống--</span>
            </div>
            <div class="static-body">
                <span>Số lượng:</span>
                <span><?= $statics['total_student'] ?></span>
            </div>
        </div>
    </div>
</div>
<?php require_once("footer.php") ?>