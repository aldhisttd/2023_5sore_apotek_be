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
$gambar = $_POST['gambar'];
$kode_kategori = $_POST['kode_kategori'];
$kode_supplier = $_POST['kode_supplier'];
$harga = $_POST['harga'];

// cek duplikat
$query = mysqli_query($koneksi, "SELECT * FROM obat WHERE kode = '$kode'");
$row = mysqli_num_rows($query);

if($row == 1){

    $response['status'] = 400;
    $response['msg'] = 'data sudah ada';
} else {

    $response['status'] = 200;
    $response['msg'] = 'data berhasil ditambah';
    $response['body']['data']['kode'] = $kode;
    $response['body']['data']['nama'] = $nama;
    $response['body']['data']['gambar'] = $gambar;
    $response['body']['data']['kode_kategori'] = $kode_kategori;
    $response['body']['data']['kode_supplier'] = $kode_supplier;
    $response['body']['data']['harga'] = $harga;
    
    mysqli_query($koneksi, "INSERT INTO obat (kode, nama, gambar, kode_kategori, kode_supplier, harga) VALUES ('$kode', '$nama', '$gambar', '$kode_kategori', '$kode_supplier', '$harga')");
}

echo json_encode($response);


