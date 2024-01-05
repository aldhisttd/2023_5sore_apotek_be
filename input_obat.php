<?php
include 'env.php';

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];

    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $kode_kategori = $_POST['kode_kategori'];
    $kode_supplier = $_POST['kode_supplier'];
    $harga = $_POST['harga'];
    $desc = mysqli_real_escape_string($koneksi, $_POST['desc']);

// cek duplikat
$query = mysqli_query($koneksi, "SELECT * FROM obat WHERE kode = '$kode'");
$row = mysqli_num_rows($query);

if($row == 1){

    $response['status'] = 400;
    $response['msg'] = 'data sudah ada';
} else {

    $temp = explode(".", $_FILES["gambar"]["name"]);
    $namaGambarBaru = md5(date('dmy h:i:s')) . '.' . end($temp);
    $target_file = "upload/" . $namaGambarBaru;
    move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

    $response['status'] = 200;
    $response['msg'] = 'data berhasil ditambah';
    $response['body']['data']['kode'] = $kode;
    $response['body']['data']['nama'] = $nama;
    $response['body']['data']['gambar'] = 'upload/'.$namaGambarBaru;
    $response['body']['data']['kode_kategori'] = $kode_kategori;
    $response['body']['data']['kode_supplier'] = $kode_supplier;
    $response['body']['data']['harga'] = $harga;
    $response['body']['data']['desc'] = $desc;
    mysqli_query($koneksi, "INSERT INTO obat (kode, nama, gambar, kode_kategori, kode_supplier, harga, deskripsi) VALUES ('$kode', '$nama', 'upload/$namaGambarBaru', '$kode_kategori', '$kode_supplier', '$harga', '$desc')");
}

echo json_encode($response);