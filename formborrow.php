<?php
session_start();
$book_id = isset($_GET['book_id']) ? $_GET['book_id'] : null;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        form {
            margin: 1rem auto;
            padding: 1rem;
            max-width: 400px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        form h2 {
            margin-top: 0;
        }

        form div {
            margin-bottom: 0.5rem;
        }

        form label {
            display: inline-block;
            width: 100px;
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="date"] {
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        form button[type="submit"] {
            margin-top: 0.5rem;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 3px;
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <form id="formBorrow" action="process/borrow_book.php" method="POST">
        <h2>Thông tin mượn sách</h2>
        <div>
            <input type="text" value="<?=$_SESSION['user']['student_id']?>" hidden id="student-id" name="student-id" required>
        </div>

        <div>
            <input type="text" id="book-id" value="<?= $book_id ?>" name="book-id" hidden>
        </div>
        <div>
            <label for="borrow-date">Ngày mượn:</label>
            <input type="date" id="borrow-date" name="borrow-date" required>
        </div>
        <div>
            <label for="return-date">Ngày trả:</label>
            <input type="date" id="return-date" name="return-date" required>
        </div>
        <button name="submitBorrow" type="submit">Mượn sách</button>
    </form>

</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $("#formBorrow").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "process/borrow_book.php",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (response.status == '1') {
                    toastr.success(response.msg, 'success!')
                    setTimeout(() => {
                        window.location.href = 'index.php';
                    }, 3000);
                } else {
                    toastr.error(response.msg, 'error!')
                    setTimeout(() => {
                        window.location.href = 'index.php';
                    }, 3000);
                }
            }
        });
    })
</script>

</html>