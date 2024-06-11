<?php


session_start();
require 'fungcions.php';

// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // Ambil user name berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // Cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}


if (isset($_POST["login"])) {
    $user = $_POST["user"];
    $pass = $_POST["pass"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user'");

    if (mysqli_num_rows($result) === 1) {
        // Cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row["pass"])) {
            // set session
            $_SESSION["login"] = true;

            // cek remember me
            if (isset($_POST["remember"])) {
                // buat cookie
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['user']), time() + 60);
            }

            header("Location: index.php");

            exit;
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
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
            background-color: rgba(0, 0, 0, 0.1);
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }

        a {
            color: blue;
            text-decoration: none;
            font-style: italic;
        }

        a:hover {
            color: red;
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
            background-color: black;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: maroon;
        }
    </style>
</head>

<body>
    <form action="" method="post">
        <h1>Halaman Login</h1>
        <?php if (isset($error)) : ?>
            <p style="color: red; font-style:italic;">username / password salah</p>
        <?php endif; ?>

        <div>
            <a href="registrasi.php">Register</a>
        </div>
        <br>
        <div>
            <label for="user">Username</label>
            <input type="text" name="user" id="user" required>
        </div>
        <div>
            <label for="pass">Password</label>
            <input type="password" name="pass" id="pass" required>
        </div>
        <div>
            <label for="remember">Remember me</label>
            <input type="checkbox" name="remember" id="remember">
        </div>
        <div>
            <button type="submit" name="login">Login</button>
        </div>
    </form>
</body>

</html>