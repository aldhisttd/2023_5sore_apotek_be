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

// cek duplikat
$query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE kode = '$kode'");
$row = mysqli_num_rows($query);

if($row == 1){

    $response['status'] = 400;
    $response['msg'] = 'data sudah ada';
} else {

    $response['status'] = 200;
    $response['msg'] = 'data berhasil ditambah';
    $response['body']['data']['kode'] = 'kode';
    $response['body']['data']['nama'] = 'nama';
    
    mysqli_query($koneksi, "INSERT INTO kategori (kode, nama) VALUES ('$kode', '$nama')");
}

echo json_encode($response);