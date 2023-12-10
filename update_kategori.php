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

if(!isset($koneksi)){
   
    $response['status'] = 400;
    $response['msg'] = 'data gagal diubah';    

} else {


mysqli_query($koneksi, "UPDATE kategori SET kode = '$kode', nama = '$nama' WHERE kode = '$kode'");

$response['status'] = 200;
$response['msg'] = 'data berhasil diubah';
$response['body']['data']['kode'] = $kode;
$response['body']['data']['nama'] = $nama;

}


echo json_encode($response);