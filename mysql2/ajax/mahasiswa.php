<?php
require '../fungcions.php';
$keyword = $_GET['keyword'];

$query = "SELECT * FROM mahasiswa";

$mahasiswa = query($query);

?>

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