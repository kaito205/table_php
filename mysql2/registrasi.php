<?php


require 'fungcions.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
        alert('User Berhasil Di Tambah'); window.location.href = 'login.php';
        </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        form {
            max-width: 400px;
            padding: 20px;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            /* Adding box shadow for floating effect */
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <form action="" method="post">
        <h1>Halaman Registrasi</h1>
        <div>
            <label for="user">Username</label>
            <input type="text" name="user" id="user" required>
        </div>
        <div>
            <label for="pass">Password</label>
            <input type="password" name="pass" id="pass" required>
        </div>
        <div>
            <label for="pass2">Konfirmasi Password</label>
            <input type="password" name="pass2" id="pass2" required>
        </div>
        <div>
            <button type="submit" name="register">Register</button>
        </div>
    </form>
</body>

</html>