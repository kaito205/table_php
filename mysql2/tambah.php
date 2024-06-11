<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'fungcions.php';

// cek apakah tombol sumbit sudah pernah ditekan
if (isset($_POST["sumbit"])) {


    if (tambah($_POST) > 0) {
        echo "
        <script>
        alert('Data berhasil ditambahkan');
        document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo " <script>
        alert('Data gagal ditambahkan');
        document.location.href = 'index.php';
        </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            text-align: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <h1>Tambah Data Mahasiswaa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="nim">Nim :</label></td>
                <td><input type="text" name="nim" id="nim" required></td>
            </tr>
            <tr>
                <td><label for="nama">Nama :</label></td>
                <td><input type="text" name="nama" id="nama" required></td>
            </tr>
            <tr>
                <td><label for="email">Email :</label></td>
                <td><input type="text" name="email" id="email" required></td>
            </tr>
            <tr>
                <td><label for="jurusan">Jurusan</label></td>
                <td><input type="text" name="jurusan" id="jurusan" required></td>
            </tr>
            <tr>
                <td><label for="gambar">Gambar</label></td>
                <td><input type="file" name="gambar" id="gambar"></td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit" name="sumbit">Simpan</button></td>
            </tr>
        </table>
    </form>
</body>

</html>