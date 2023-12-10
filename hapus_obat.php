<?php
include 'env.php';

$response = [
    'status' => '200',
    'msg' => 'Data berhasil dihapus',
    'body' => [
        'data' => [
            'kode' => $kode_obat
        ]
    ]
];

$response = array();

if (isset($_POST['kode'])) {
    $kode_obat = $_POST['kode'];

    $q = mysqli_query($koneksi, "SELECT gambar FROM obat WHERE kode='$kode_obat'");
    
    if ($q) {
        $ary = mysqli_fetch_array($q);
        $file = $ary['gambar'];

        unlink("upload/" . $file);

        $delete_query = mysqli_query($koneksi, "DELETE FROM obat WHERE kode='$kode_obat'");

    }
}
echo json_encode($response);
?>

