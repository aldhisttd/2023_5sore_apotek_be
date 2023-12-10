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
$alamat = $_POST['alamat'];
$hp = $_POST['hp'];

if(!isset($koneksi)){

    $response['status'] = 400;
    $response['msg'] = 'data gagal diubah';    
} else {

    mysqli_query($koneksi, "UPDATE supplier SET kode = '$kode', nama = '$nama', alamat = '$alamat', hp = '$hp' WHERE kode = '$kode'");

    $response['status'] = 200;
    $response['msg'] = 'data berhasil diubah';
    $response['body']['data']['kode'] = $kode;
    $response['body']['data']['nama'] = $nama;
    $response['body']['data']['alamat'] = $alamat;
    $response['body']['data']['hp'] = $hp;        
}

echo json_encode($response);