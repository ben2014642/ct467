<?php


?>

<!DOCTYPE html>
<html>

<head>
    <title>Library Registration Form</title>
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
        <h2>Add Book</h2>
        <form action="#" id="formAddBook" method="post">
            <div class="form-group">
                <label for="username">Title</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="thumbnail">Thumbnail</label>
                <input type="text" id="thumbnail" name="thumbnail" required>
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" id="author" name="author" required>
                <div id="password-match-error" class="error-message"></div>
            </div>
            <div class="form-group">
                <label for="publisher">Publisher</label>
                <input type="text" id="publisher" name="publisher" required>
            </div>
            <div class="form-group">
                <label for="publication_date">Publication Date</label>
                <input type="date" id="publication_date" name="publication_date" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="text" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="0">Draft</option>
                    <option value="1">Public</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $("#formAddBook").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "process-book.php",
            data: $(this).serialize()+"&type=add",
            dataType: "json",
            success: function(response) {
                if (response.status == 'success') {
                    toastr.success('Thêm sách thành công !')
                    setTimeout(() => {
                        window.location.href = 'index.php';
                    }, 3000);
                } else {
                    toastr.error('Đã xảy ra lỗi !')

                }
            }
        });
    })
</script>