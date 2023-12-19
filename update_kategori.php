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

    $response['status'] = 200;
    $response['msg'] = 'data berhasil diubah';
    $response['body']['data']['kode'] = $kode;
    $response['body']['data']['nama'] = $nama;

    mysqli_query($koneksi, "UPDATE kategori SET nama = '$nama' WHERE kode = '$kode'");
}

echo json_encode($response);