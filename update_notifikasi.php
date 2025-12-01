<?php
session_start();
include 'koneksi.php';

if (isset($_POST['idakun'])) {
    $idakun = $_POST['idakun'];

    // Update status notifikasi agar tidak dihitung lagi
    $query = "UPDATE orderan SET status_notifikasi = '1' WHERE idakun = '$idakun' AND status IN ('Pesanan Di Tolak', 'Barang Di Kemas', 'Barang Di Kirim', 'Pesanan Sampai Ke Lokasi Pemesan')";
    $koneksi->query($query);

    echo "success";
} else {
    echo "error";
}
?>
