// Ambil Elemen2 Yang Dibutuhkan
var keyword = document.getElementById("keyword");
var tombolCari = document.getElementById("tombol-cari");
var container = document.getElementById("container");

// Tambahkan event ketika keyword diketik
keyword.addEventListener("keyup", function () {
  // buat object AJAK
  var xhr = new XMLHttpRequest();

  // cek kesiapan AJAX
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      container.innerHTML = xhr.responseText;
    }
  };

  // eksekusi AJAX
  xhr.open("GET", "ajax/mahasiswa.php?keyword=" + keyword.value, true);
  xhr.send();
});
