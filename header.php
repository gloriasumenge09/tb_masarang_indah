<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>TB. Masarang Indah</title>
    <link rel="shortcut icon" type="image/png" href="../foto/ikonbg1.png">
    <link rel="stylesheet" href="assets/dist/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/dist/assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/dist/assets/modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="assets/dist/assets/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="assets/dist/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/dist/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/dist/assets/css/style.css">
    <link rel="stylesheet" href="assets/dist/assets/css/components.css">
    <link rel="stylesheet" href="assets/dist/assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="assets/dist/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <script src="assets/ckeditor/ckeditor.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
</head>
<?php
session_start();
include '../koneksi.php';
if (!isset($_SESSION['akun'])) {
    echo "<script>alert('Anda Harus Login');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}
function harga($angka)
{
    $hasilharga = "Rp " . number_format($angka, 2, ',', '.');
    return $hasilharga;
}
function tanggal($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = bulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function bulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}
$idakun = $_SESSION['akun']['idakun'];
$ambilprofil = $koneksi->query("SELECT * FROM akun WHERE idakun='$idakun'");
$profil = $ambilprofil->fetch_assoc();
?>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <?php
                    // Ambil jumlah notifikasi
                    $notifikasi_query = "SELECT COUNT(*) as jumlah FROM orderan WHERE status = 'Sudah Upload Bukti Pembayaran'";
                    $notifikasi_result = $koneksi->query($notifikasi_query);
                    $notifikasi_count = $notifikasi_result->fetch_assoc()['jumlah'];
                    ?>

                    <!-- Notifikasi -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownNotifikasi" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <?php if ($notifikasi_count > 0) : ?>
                                <span class="badge badge-danger badge-counter"><?= $notifikasi_count ?></span>
                            <?php endif; ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="dropdownNotifikasi">
                            <h6 class="dropdown-header">Notifikasi</h6>
                            <?php if ($notifikasi_count > 0) : ?>
                                <?php
                                // Ambil notifikasi dengan menyesuaikan id akun adalah idakun
                                $notifikasi_query = "SELECT p.*, u.nama 
                                 FROM orderan p 
                                 JOIN akun u ON p.idakun = u.idakun 
                                 WHERE p.status = 'Sudah Upload Bukti Pembayaran'";
                                $notifikasi_result = $koneksi->query($notifikasi_query);
                                while ($row = $notifikasi_result->fetch_assoc()) :
                                ?>
                                    <a class="dropdown-item d-flex align-items-center" href="order.php?id=<?= $row['idorderan'] ?>">
                                        <div>
                                            <div class="text-truncate">Pembayaran dari <?= $row['nama'] ?><br> perlu dikonfirmasi.</div>
                                            <div class="small text-gray-500 mt-3"><?= tanggal($row['tanggalbeli']); ?></div>
                                        </div>
                                    </a>
                                <?php endwhile; ?>
                                <a class="dropdown-item text-center small text-gray-500" href="daftarorder.php">Lihat Semua Notifikasi</a>
                            <?php else : ?>
                                <a class="dropdown-item text-center small text-gray-500">Tidak ada notifikasi</a>
                            <?php endif; ?>
                        </div>
                    </li>

                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="../foto/user.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block"><?= $profil['nama'] ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="ubahprofil.php" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profil
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="keluar.php" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="beranda.php">Admin</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="beranda.php"></a>
                    </div>
                    <ul class="sidebar-menu">
                        <li><a class="nav-link" href="index.php"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Produk</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="daftarproduk.php">Data Produk</a></li>
                                <li><a class="nav-link" href="daftarkategori.php">Data Kategori</a></li>
                            </ul>
                        </li>
                        <li><a class="nav-link" href="daftarorder.php"><i class="fas fa-pencil-ruler"></i> <span>Order</span></a></li>
                        <li><a class="nav-link" href="laporan.php"><i class="fas fa-book"></i> <span>Laporan</span></a></li>
                        <li><a class="nav-link" href="apriori.php"><i class="fas fa-list"></i> <span>Analisis Apriori</span></a></li>
                        <li><a class="nav-link" href="daftarpelanggan.php"><i class="fas fa-user"></i> <span>Pelanggan</span></a></li>
                    </ul>
                </aside>
            </div>
            <div class="main-content">
                <section class="section">