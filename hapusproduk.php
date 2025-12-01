<?php
include '../koneksi.php';
$koneksi->query("DELETE FROM produk WHERE idproduk='$_GET[id]'");
echo "<script>alert('Data Berhasil Di Hapus');</script>";
echo "<script> location ='daftarproduk.php';</script>";
