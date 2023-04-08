<?php
session_start();
require_once("lib/conf.php");

$sql = "SELECT * FROM borrows
JOIN books ON borrows.book_id = books.book_id
";
$borrows = [];
$query = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($query, 1)) {
    $borrows[] = $row;
}


$sql = "SELECT * FROM donate_books
JOIN books ON donate_books.book_id = books.book_id
";
$donates = [];
$query = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($query, 1)) {
    $donate[] = $row;
}

?>
<?php require_once("include/header.php") ?>
<div class="content">
    <main>
        <section class="gift">
            <div class="msg">

            </div>
            <input hidden id="student_id" type="text" value="<?= $dataUser['student_id'] ?>">
            <p>Chức năng đổi thưởng cho thành viên là một tính năng hữu ích giúp khuyến khích người dùng sử dụng chương trình . Khi mượn sách hoặc quyên góp sách, người dùng sẽ được cộng điểm vào tài khoản. Khi đủ điểm, bạn có thể đổi phần thưởng tương ứng.</p>
            <p class="current-mark">Điểm hiện tại: <?= $dataUser['diem'] ?></p>
            <span class="btn btnSuccess btnDoiDiem">Đổi điểm</span>
            <table style="width: 100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Book Title</th>
                        <th>Hoạt Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($borrows as $item) {
                        $stt = 1;
                        echo '
                            <tr>
                                <td>' . $stt . '</td>
                                <td>' . $item['title'] . '</td>
                                <td>Mượn sách</td>
                            </tr>
                            ';
                        $stt++;
                    }
                    ?>

                </tbody>
            </table>
            <hr>
            <?php
            if (count($donates) <= 0) {
                goto exitTable;
            }
            ?>
            <table style="width: 100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Book Title</th>
                        <th>Hoạt Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($donates as $item) {
                        $stt = 1;
                        echo '
                                <tr>
                                    <td>' . $stt . '</td>
                                    <td>' . $item['title'] . '</td>
                                    <td>Góp sách</td>
                                </tr>
                                ';
                        $stt++;
                    }

                    ?>

                </tbody>
            </table>
            <?php exitTable: ?>
        </section>
    </main>
</div>
<?php require_once("include/footer.php") ?>
<script>
    $(".btnDoiDiem").click(function() {
        if (!confirm('Bạn có chắc chắn muốn đổi điểm ?')) {
            return;
        }

        $.ajax({
            type: "POST",
            url: "process/doidiem.php",
            data: {
                student_id: $("#student_id").val()
            },
            dataType: "json",
            success: function(response) {
                let msg = '';
                if (response.status == 'error') {
                    msg = `<p class="msg-error">${response.msg}</p>`
                } else {
                    msg = `<p class="msg-success">${response.msg}</p>`
                }
                $(".msg").append(msg)
                setTimeout(() => {
                    window.location.reload()
                }, 1500);
            }
        });
    })
</script>