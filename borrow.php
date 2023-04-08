<?php
session_start();
require_once("lib/conf.php");
$user = $_SESSION['user'];
$student_id = $user['student_id'];
$sql = "SELECT borrows.status,borrows.borrow_id,books.title,students.name,borrows.borrow_date,borrows.return_date from borrows
        JOIN books ON borrows.book_id = books.book_id
        JOIN students ON borrows.student_id = students.student_id WHERE students.student_id = $student_id";
$query = mysqli_query($conn, $sql);
$data = [];
while ($row = mysqli_fetch_array($query, 1)) {
    $data[] = $row;
}
// print_r($user);die;
?>
<?php require_once("include/header.php") ?>
<main>
    <section>
        <div class="content">
            <div class="borrowed-books">
                <a href="javascript:history.back(1);" class="btn btnDanger">Quay lại</a>

                <h2>Borrow Books</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Book Name</th>
                            <th>Borrower Name</th>
                            <th>Borrow Date</th>
                            <th>Return Date</th>
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
                        
                        <td>' . $status . '</td>
                    </tr>';
                        }
                        ?>

                    </tbody>
                </table>
            </div>

        </div>
    </section>
</main>

<?php require_once("include/footer.php") ?>