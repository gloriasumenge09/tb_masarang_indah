<?php
require_once 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    if ($status == 'settlement' || $status == 'capture') {
        $statusupdate = 'Sudah Upload Bukti Pembayaran';
    } else {
        $statusupdate = 'Belum Bayar';
    }
    $koneksi->query("UPDATE orderan SET status='$statusupdate'
        WHERE invoice='$id'");

    echo '<script>location="riwayat.php";</script>';
}
