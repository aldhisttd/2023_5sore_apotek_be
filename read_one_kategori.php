<?php
include 'env.php';

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];

$kode = $_GET['kode'];

$result = mysqli_query($koneksi, "SELECT * FROM kategori WHERE kode = '$kode'");
$rows = mysqli_num_rows($result);

if($rows == 1){
    while ($row = mysqli_fetch_assoc($result)){
        $data = $row;
    }
    $response['status'] = 200;
    $response['msg'] = 'success';
    $response['body']['data'] = $data;
} 
if($rows == 0) {
    $response['status'] = 400;
    $response['msg'] = 'error';
}

echo json_encode($response);