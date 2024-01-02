<?php
include 'env.php';

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];

if (!isset($koneksi)) {

    $response['status'] = 400;
    $response['msg'] = 'error';
} else {

    $query = " SELECT *, kategori.nama as nama_kategori, supplier.nama as nama_supplier
    FROM obat
    INNER JOIN kategori ON obat.kode_kategori = kategori.kode
    INNER JOIN supplier ON obat.kode_supplier = supplier.kode
    ";

    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    
    $response['status'] = 200;
    $response['msg'] = 'success';
    $response['body']['data'] = $row;
}

echo json_encode($response);
