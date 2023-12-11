<?php
include 'env.php';

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => [
            'kode' => '',
            'nama' => '',
            'kode_kategori' => '',
            'kode_supplier' => '',
            'gambar' => '',
            'harga' => '',
        ]
    ]
];

$kode = $_POST['kode'];
$nama = $_POST['nama'];
$kode_kategori = $_POST['kode_kategori'];
$kode_supplier = $_POST['kode_supplier'];
$harga = $_POST['harga'];

if (!$koneksi) {

    $response['status'] = 400;
    $response['msg'] = "data gagal diperbarui";
} else {

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES["gambar"]["name"] != "") {
        // ambil nama gambar lama
        $result = mysqli_query($koneksi, "SELECT gambar FROM obat WHERE kode = '$kode'");
        $data = mysqli_fetch_assoc($result);
        $gambar = $data['gambar'];
        // hapus gambar lama
        unlink("upload/" . $gambar);
        // upload gambar baru
        $gambarBaru = basename($_FILES["gambar"]["name"]);
        $target_file = "upload/" . $gambarBaru;
        $upload = move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

        $response['body']['data']['gambar'] = 'upload/' . $gambarBaru;
        mysqli_query($koneksi, "UPDATE obat SET gambar = 'upload/$gambarBaru' WHERE kode = '$kode'");
    }

    $response['status'] = 200;
    $response['msg'] = 'data berhasil diperbarui';
    $response['body']['data']['kode'] = $kode;
    $response['body']['data']['nama'] = $nama;
    $response['body']['data']['kode_kategori'] = $kode_kategori;
    $response['body']['data']['kode_supplier'] = $kode_supplier;
    $response['body']['data']['harga'] = $harga;

    mysqli_query($koneksi, "UPDATE obat 
                            SET kode = '$kode', 
                                nama = '$nama', 
                                kode_kategori = '$kode_kategori',
                                kode_supplier = '$kode_supplier',
                                harga = '$harga'
                            WHERE kode = '$kode'");
}

echo json_encode($response);
