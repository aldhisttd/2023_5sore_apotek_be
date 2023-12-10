<?php
include 'env.php';

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => [
            'kode' => '',
        ]
    ]
];


if (isset($_POST['kode'])) {
    $kode_obat = $_POST['kode'];

    $q = mysqli_query($koneksi, "SELECT gambar FROM obat WHERE kode='$kode_obat'");
    
    if ($q) {
        $ary = mysqli_fetch_array($q);
        $file = $ary['gambar'];

        unlink("upload/" . $file);

        $delete_query = mysqli_query($koneksi, "DELETE FROM obat WHERE kode='$kode_obat'");
        $response['status'] = 200;
        $response['msg'] = 'Data Berhasil dihapus';
        $response['body']['data']['kode'] = $kode_obat;
    }else {
        $response['status'] = 400;
        $response['msg'] = 'Data gagal dihapus';
        $response['body']['data']['kode'] = $kode_obat;
    }
}
echo json_encode($response);
?>


