<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'fungcions.php';

// pagination
// konfigurasi
$jdh = 2;
$jd = count(query("SELECT * FROM mahasiswa"));
$jh = ceil($jd / $jdh);
$ha = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$ad = ($jdh * $ha) - $jdh;


$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $ad, $jdh");

// mencari data di halaman
if (isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: wheat;
            align-items: center;
        }

        h1 {
            text-align: center;
        }

        a {
            font-style: italic;
            font-size: 20px;
            text-decoration: none;
            color: black;
            transition: 0.1s;
            margin-right: 5px;
            /* Jarak antara link */
        }

        a:hover {
            color: red;
        }

        img {
            width: 50px;
            height: 50px;
            box-shadow: 0px 0px 0px 3px orange;
            transition: 1s;
        }

        img:hover {
            border-radius: 50%;
        }

        table {
            text-align: center;
            margin: 0 auto;
            width: 80%;
            border-collapse: collapse;
        }

        /* Style untuk form pencarian */
        form {
            text-align: left;
            margin-bottom: 5px;
        }

        /* Style untuk input pencarian */
        input[type="text"] {
            padding: 6px;
            width: 250px;
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        /* Style untuk tombol pencarian */
        button[type="submit"] {
            padding: 8px 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Hover effect untuk tombol pencarian */
        button[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Style untuk navigasi */
        .pagination {
            margin: 8px 0;
            text-align: center;
        }

        .pagination a {
            display: inline-block;
            padding: 8px 10px;
            text-decoration: none;
            color: black;
            border: 1px solid #ddd;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <a href="logout.php">Logout</a>
    <h1>Daftar Mahasiswa</h1>
    <a href="tambah.php">Tambah data mahasiswa</a>
    <br><br>
    <form action="" method="post">
        <input type="text" name="keyword" placeholder="cari nama atau nim" autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari Data Mahasiswa</button>
    </form>
    <br>
    <!-- navigasi -->

    <?php if (!isset($_POST["cari"])) : ?>
        <div class="pagination">
            <?php if ($ha > 1) : ?>
                <a href="?halaman=<?= $ha - 1; ?>">&laquo;</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $jh; $i++) : ?>
                <?php if ($i == $ha) : ?>
                    <a href="?halaman=<?= $i; ?>" class="active"><?= $i; ?></a>
                <?php else : ?>
                    <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($ha < $jh) : ?>
                <a href="?halaman=<?= $ha + 1; ?>">&raquo;</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>


    <div id="container">
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No.</th>
                <th>Gambar</th>
                <th>Nim</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach ($mahasiswa as $row) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td>
                        <img src="../img/<?= $row["gambar"]; ?>" alt="error">
                    </td>
                    <td><?= $row["nim"]; ?></td>
                    <td><?= $row["nama"]; ?></td>
                    <td><?= $row["email"]; ?></td>
                    <td><?= $row["jurusan"]; ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row["id"]; ?>">Edit</a>
                        <br>
                        <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data mahasiswa ini? Tindakan ini tidak dapat dibatalkan.');">Hapus</a>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    </div>

    <script src="js/script.js"></script>

</body>

</html>