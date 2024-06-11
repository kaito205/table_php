<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {

        $rows[] = $row;
    }
    return $rows;
}


// Funcition untuk Tambah
function tambah($data)
{
    global $conn;
    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);


    // upload gambar 
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO mahasiswa
    VALUES
    ('', '$nim', '$nama', '$email', '$jurusan', '$gambar' )
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// funcion upload
function upload()
{

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yg diupload
    if ($error === 4) {
        echo "<script>
    alert('Masukan gambar terlebihdahulu');
    </script>";

        return false;
    }
    // cek apakah yg diupload adalah gambar

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('Yang anda upload bukan gambar');
        </script>";

        return false;
    }

    // cek jika ukuran gambar terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>
        alert('Ukuran Gambar terlalu besar');
        </script>";

        return false;
    }

    // Lolos pengecekan gambar
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, '../img/' . $namaFileBaru);

    return $namaFileBaru;
}




// fungcion untukk Hapus
function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// funcion untuk edit
function edit($data)
{
    global $conn;
    $id = $data["id"];
    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // Cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE  mahasiswa SET
    nim = '$nim',
    nama = '$nama',
    email = '$email',
    jurusan = '$jurusan',
    gambar = '$gambar'
    WHERE id = $id
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// funcion untung mencari data
function cari($keyword)
{
    $query = "SELECT * FROM mahasiswa WHERE 
    nama LIKE '%$keyword%' OR 
    nim LIKE '%$keyword%'
    ";

    return query($query);
}

//fungcion registrasi
function registrasi($data)
{
    global $conn;

    $user = stripslashes($data["user"]);
    $pass = mysqli_real_escape_string($conn, $data["pass"]);
    $pass2 = mysqli_real_escape_string($conn, $data["pass2"]);

    // cek usernama sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE 
    username = '$user'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('User Sudah Terdaftar');
        </script>";

        return false;
    }

    // cek konfirmasi password
    if ($pass !== $pass2) {
        echo "<script>
        alert('Password Tidak Sesuai');
        </script>";

        return false;
    }
    // enkripsin password
    $pass = password_hash($pass, PASSWORD_DEFAULT);

    // TAMBAHKAN USERBARU KE DATABASE 
    mysqli_query($conn, "INSERT INTO user VALUE('', '$user', '$pass')");

    return mysqli_affected_rows($conn);
}
