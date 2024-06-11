<?php
// cek apakah tombol sumbit sudah ditekan atau belum
if (isset($_POST["sumbit"])) {
    // cek username dan password
    if ($_POST["username"] == "kaito" && $_POST["password"] == "123") {
        // jika benar redirect ke halaman admin
        header("Location: admin.php");
        exit;
    } else {
        // jika salah tampilkan pesan kesalahan
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Login admin</h1>

    <?php if (isset($error)) : ?>
        <p style="color: red; font-style:italic;">Username atau password salah</p>
    <?php endif; ?>

    <ul>
        <form action="" method="post">
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="pass">Password :</label>
                <input type="password" name="password" id="pass">
            </li>
            <li>
                <button type="submit" name="sumbit">kirim</button>
            </li>
        </form>
    </ul>
</body>

</html>