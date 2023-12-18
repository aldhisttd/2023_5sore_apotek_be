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

    $result = mysqli_query($koneksi, "SELECT * FROM kategori");
    $rows = mysqli_num_rows($result);

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    $response['status'] = 200;
    $response['msg'] = 'success';
    $response['body']['data'] = $data;
}

echo json_encode($response);