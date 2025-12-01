<?php
include '../koneksi.php';
$koneksi->query("DELETE FROM akun WHERE id='$_GET[id]'");
echo "<script>alert('Data Berhasil Di Hapus');</script>";
echo "<script> location ='daftarpelanggan.php';</script>";
