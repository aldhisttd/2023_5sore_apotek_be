<?php
include 'env.php';

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];

if(!isset($koneksi)){

    $response['status'] = 400;
    $response['msg'] = 'data gagal diubah';    
} else {

    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];

    $response['status'] = 200;
    $response['msg'] = 'data berhasil diubah';
    $response['body']['data']['kode'] = $kode;
    $response['body']['data']['nama'] = $nama;
    $response['body']['data']['alamat'] = $alamat;
    $response['body']['data']['hp'] = $hp;        

    mysqli_query($koneksi, "UPDATE supplier SET nama = '$nama', alamat = '$alamat', hp = '$hp' WHERE kode = '$kode'");
}

echo json_encode($response);