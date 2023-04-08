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
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Library Login Form</h2>
        <form action="#" id="formLogin" method="POST">
            <div class="form-group">
                <label for="username">Email</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $("#formLogin").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "process/login.php",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                toastr.success('Đăng nhập thành công !')
                setTimeout(() => {
                    window.location.href = 'index.php';
                }, 1500);
            },
            error: function(response) {
                toastr.error('Sai tên tài khoản hoặc mật khẩu !')

            }
        });
    })
</script>