<?php
include 'env.php';

$response = array();

if (isset($_POST['kode'])) {
    $kode_obat = $_POST['kode'];

    $q = mysqli_query($koneksi, "SELECT gambar FROM obat WHERE kode='$kode_obat'");
    
    if ($q) {
        $ary = mysqli_fetch_array($q);
        $file = $ary['gambar'];

        unlink("upload/" . $file);

        $delete_query = mysqli_query($koneksi, "DELETE FROM obat WHERE kode='$kode_obat'");

        if ($delete_query) {
            $response['success'] = true;
            $response['msg'] = "Obat dengan kode $kode_obat berhasil dihapus.";
        } else {
            $response['success'] = false;
            $response['msg'] = "Gagal menghapus obat. Error: " . mysqli_error($koneksi);
        }
    } else {
        $response['success'] = false;
        $response['msg'] = "Gagal mengambil data obat. Error: " . mysqli_error($koneksi);
    }
} else {
    $response['success'] = false;
    $response['msg'] = "Parameter kode tidak diberikan.";
}

echo json_encode($response);
?>
