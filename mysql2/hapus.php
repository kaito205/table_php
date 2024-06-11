<?php


require 'fungcions.php';
$id = $_GET["id"];

if (hapus($id) > 0) {
    echo "
        <script>
        alert('Data berhasil di Hapus');
        document.location.href = 'index.php';
        </script>
        ";
} else {
    echo " <script>
        alert('Data gagal di Hapus');
        document.location.href = 'index.php';
        </script>";
}
