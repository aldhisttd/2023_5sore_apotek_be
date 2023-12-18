<?php
include 'env.php';

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => [
            'kode' => '',
            'nama' => '',
            'alamat' => '',
            'hp' => '',
        ]
    ]
];

$kode = $_POST['kode'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$hp = $_POST['hp'];

$result = mysqli_query($koneksi, "SELECT * FROM supplier WHERE kode = '$kode'");
$row = mysqli_num_rows($result);

if ($row == 1) {

    $response['status'] = 400;
    $response['msg'] = 'gagal, kategori sudah ada';
} else {

    $response['status'] = 200;
    $response['msg'] = 'data berhasil diinsert';
    $response['body']['data']['kode'] = $kode;
    $response['body']['data']['nama'] = $nama;
    $response['body']['data']['alamat'] = $alamat;
    $response['body']['data']['hp'] = $hp;

    mysqli_query($koneksi, "INSERT INTO supplier VALUES ('$kode', '$nama', '$alamat', '$hp')");
}

echo json_encode($response);
