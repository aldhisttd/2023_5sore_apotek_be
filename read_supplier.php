<?php
include 'env.php';

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];

$result = mysqli_query($koneksi, "SELECT * FROM supplier");
$rows = mysqli_num_rows($result);

if ($rows == 0) {

    $response['status'] = 400;
    $response['msg'] = 'error';
} else {

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    $response['status'] = 200;
    $response['msg'] = 'success';
    $response['body']['data'] = $data;
}

echo json_encode($response);
