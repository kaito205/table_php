<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'fungcions.php';

// Ambil data di ULR
$id = $_GET["id"];
// query data mahasiswa berdasarkan id 
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

// cek apakah tombol sumbit sudah pernah ditekan
if (isset($_POST["sumbit"])) {

    // cek apakah data berhasil diubah
    if (edit($_POST) > 0) {
        echo "
        <script>
        alert('Data berhasil di Edit');
        document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo " <script>
        alert('Data gagal di Edit');
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
    <title>Edit Data Mahasiswa</title>
</head>

<body>
    <h1>Edit Data Mahasiswaa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
        <ul>
            <li>
                <label for="nim">Nim :</label>
                <input type="text" name="nim" id="nim" required value="<?= $mhs["nim"]; ?>">
            </li>
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" required value="<?= $mhs["nama"]; ?>">
            </li>
            <li>
                <label for="email">Email :</label>
                <input type="text" name="email" id="email" required value="<?= $mhs["email"]; ?>">
            </li>
            <li>
                <label for="jurusan">Jurusan</label>
                <input type="text" name="jurusan" id="jurusan" required value="<?= $mhs["jurusan"]; ?>">
            </li>
            <li>
                <label for="gambar">Gambar</label>
                <img src="../img/<?= $mhs["gambar"]; ?>" width="100" alt="Error"> <br>
                <input type="file" name="gambar" id="gambar" ">
            </li>
            <li>
                <button type=" submit" name="sumbit">Simpan</button>
            </li>
        </ul>
    </form>
</body>

</html>