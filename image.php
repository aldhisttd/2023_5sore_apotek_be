<?php
$temp = explode(".", $_FILES["gambar"]["name"]);
$namaGambarBaru = md5(date('dmy h:i:s')) . '.' . end($temp);
// $nama_gambar = md5(date('dmy h:i:s'));

$target_file = "upload/" . $namaGambarBaru;
move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

// mysqli_query($koneksi, "UPDATE obat SET gambar = 'upload/$gambarBaru' WHERE kode = '$kode'");
