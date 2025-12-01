<?php 
session_start();
$idproduk=$_GET["id"];
unset($_SESSION["keranjang"][$idproduk]);
include 'koneksi.php';

echo "<script> alert('Produk Terhapus');</script>";
echo "<script> location ='keranjang.php';</script>";
