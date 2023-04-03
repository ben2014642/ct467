<?php
require_once("../lib/conf.php");

if (isset($_POST['search'])) {
    $search = $_POST['search'];
} else {
    $search = '';
}
$sql = "SELECT borrows.borrow_id,students.student_id,students.name,books.title FROM borrows
            JOIN students ON borrows.student_id = students.student_id
            JOIN books ON borrows.book_id = books.book_id WHERE (borrows.borrow_id) = '$search' OR (students.name) like '%$search%'
            ";
// $sql = "SELECT students.student_id,students.name,COUNT(borrows.student_id) AS total_borrow FROM borrows
//             JOIN students ON borrows.student_id = students.student_id 
//             GROUP BY students.student_id,students.name";
$query = mysqli_query($conn, $sql);

$borrows = [];
while ($row = mysqli_fetch_array($query, 1)) {
    $borrows[] = $row;
}

?>
<?php require_once("header.php") ?>
<div class="content">
    <div class="static-list">
        <form action="static-borrowed.php" method="POST">
            <div class="">
                <label for="search">Search:</label>
                <input placeholder="" type="text" id="search" name="search">
                <button type="submit"><img style="width: 19px" src="../image/search-borrow.png" alt=""></button>
            </div>
        </form>
        <h2>Borrowed By Student</h2>
        <table style="width: 100%">
            <thead>
                <tr>
                    <th>Borrow ID</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Book Name</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($borrows as $item) {
                    echo '
                        <tr>
                            <td>' . $item['borrow_id'] . '</td>
                            <td>' . $item['student_id'] . '</td>
                            <td>' . $item['name'] . '</td>
                            <td>' . $item['title'] . '</td>
                        
                        </tr>';
                }
                ?>

            </tbody>
        </table>
    </div>
</div>
<?php require_once("footer.php") ?>