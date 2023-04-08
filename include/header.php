<?php
$messageError = $messageSuccess = '';

if (isset($_POST['search'])) {
  $keyword = $_POST['search'];
  $sql = "SELECT * FROM books WHERE title LIKE '%$keyword%'";
  $query = mysqli_query($conn, $sql);
  $data = [];
  while ($row = mysqli_fetch_array($query, 1)) {
    $data[] = $row;
  }
}


if (isset($_GET['msg'])) {
  $messageError = $messageSuccess = $_GET['msg'];
}

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
  $sql = 'SELECT * FROM students WHERE student_id = ' . $user['student_id'] . ' ';
  $dataUser = mysqli_fetch_assoc(mysqli_query($conn, $sql));
}

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
      <ul class="nav">
        <div class="nav-left">
          <li><a href="/">Trang chủ</a></li>
          <?php
          if (empty($user)) {
            echo '
            <li><a href="login.php">Đăng nhập</a></li>
            <li><a href="register.php">Đăng ký</a></li>
            ';
          } else {
            echo '<li>Xin chào,<span style="color: #ff1111">' . $user['name'] . '</span><img class="user" src="image/user.png"></li>
          ';
          }
          ?>
        </div>
        <?php
        if (isset($user)) {
          echo '
          <div class="nav-right">
          <li>' . $dataUser['diem'] . ' <a href="gift.php" class="mark">Điểm,</a></li>
          <li><a style="color: red" href="borrow.php">Phiếu mượn</a></li>
            <li><a href="logout.php">Đăng xuất</a></li>
          </div>';
        }
        ?>
      </ul>
    </nav>
  </header>