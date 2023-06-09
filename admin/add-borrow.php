<?php
require_once("../lib/conf.php");
$sql = "SELECT * FROM students";
$query = mysqli_query($conn, $sql);
$students = [];
while ($row = mysqli_fetch_array($query, 1)) {
    $students[] = $row;
}

$sql = "SELECT * FROM books";
$query = mysqli_query($conn, $sql);
$books = [];
while ($row = mysqli_fetch_array($query, 1)) {
    $books[] = $row;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Borrow Book</title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        .form-container {
            background-color: #ffffff;
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
        }

        input[type=text],
        input[type=password],
        input[type=date],
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type=submit] {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button[type=submit]:hover {
            background-color: #45a049;
        }

        .cancel-btn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
            margin-top: 10px;
        }

        .cancel-btn:hover {
            background-color: #da190b;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
        }

        .btn {
            width: 85px;
            padding: 8px;
            text-decoration: none;
            border-radius: 5px;
            color: white;
        }

        .btnDanger {
            background-color: orange;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <a href="javascript:history.back(1);" class="btn btnDanger">Quay lại</a>
        <h2>Add Borrow Book</h2>
        <form action="#" id="formAddBorrow" method="post">
            <div class="form-group">
                <label for="username">Student Name</label>
                <select name="student_id" id="">
                    <?php
                    foreach ($students as $item) {
                        echo '
                            <option value="' . $item['student_id'] . '">' . $item['name'] . '</option>
                            ';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="username">Book Name</label>
                <select name="book_id" id="">
                    <?php
                    foreach ($books as $item) {
                        echo '
                        <option value="' . $item['book_id'] . '">' . $item['title'] . '(SL: '.$item['quantity'].')</option>
                        ';
                    }
                    ?>
                </select>

            </div>
            <div class="form-group">
                <label for="username">Borrow Date</label>
                <input type="date" name="borrow_date" id="">

            </div>
            <div class="form-group">
                <label for="username">Return Date</label>
                <input type="date" name="return_date" id="">

            </div>
            <div class="form-group">
                <label for="username">Status</label>
                <select name="status" id="status">
                    <option value="0">Chờ</option>
                    <option value="1">Đã mượn</option>
                </select>

            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $("#formAddBorrow").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "process-borrow.php",
            data: $(this).serialize() + "&type=add",
            dataType: "json",
            success: function(response) {
                if (response.status == 'success') {
                    toastr.success(response.msg,'success')
                    setTimeout(() => {
                        window.location.href = 'index.php';
                    }, 3000);
                } else {
                    toastr.error(response.msg,'error')

                }
            }
        });
    })
</script>