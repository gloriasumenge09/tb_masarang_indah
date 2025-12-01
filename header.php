<?php
include 'koneksi.php';
$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
  $datakategori[] = $tiap;
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

  <!-- title -->
  <title>TB. Masarang Indah</title>

  <!-- favicon -->
  <link rel="shortcut icon" type="image/png" href="foto/ikonbg1.png">
  <!-- google font -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <!-- fontawesome -->
  <link rel="stylesheet" href="assets/css/all.min.css">
  <!-- bootstrap -->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <!-- owl carousel -->
  <link rel="stylesheet" href="assets/css/owl.carousel.css">
  <!-- magnific popup -->
  <link rel="stylesheet" href="assets/css/magnific-popup.css">
  <!-- animate css -->
  <link rel="stylesheet" href="assets/css/animate.css">
  <!-- mean menu css -->
  <link rel="stylesheet" href="assets/css/meanmenu.min.css">
  <!-- main style -->
  <link rel="stylesheet" href="assets/css/main.css">
  <!-- responsive -->
  <link rel="stylesheet" href="assets/css/responsive.css">
  <style>
    .bintang {
      float: left;
      height: 46px;
      padding: 0 10px;
    }

    .bintang:not(:checked)>input {
      position: absolute;
      top: -9999px;
    }

    .bintang:not(:checked)>label {
      float: right;
      width: 1em;
      overflow: hidden;
      white-space: nowrap;
      cursor: pointer;
      font-size: 30px;
      color: #ccc;
    }

    .bintang:not(:checked)>label:before {
      content: '★ ';
    }

    .bintang>input:checked~label {
      color: #ffc700;
    }

    .bintang:not(:checked)>label:hover,
    .bintang:not(:checked)>label:hover~label {
      color: #deb217;
    }

    .bintang>input:checked+label:hover,
    .bintang>input:checked+label:hover~label,
    .bintang>input:checked~label:hover,
    .bintang>input:checked~label:hover~label,
    .bintang>label:hover~input:checked~label {
      color: #c59b08;
    }

    .tombol {
      background-image: linear-gradient(to right, #4CB8C4 0%, #3CD3AD 51%, #4CB8C4 100%);
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      border-radius: 10px;
    }
  </style>
</head>

<body>
  <div class="top-header-area" id="sticker">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-sm-12 text-center">
          <div class="main-menu-wrap">
            <div class="site-logo">
              <a href="index.php">
                <img style="height: 50px;" src="foto/ikonbg1.png" alt="">
              </a>
            </div>
            <nav class="main-menu ml-auto">
              <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="kontak.php">Kontak</a></li>
                <li><a href="tentang.php">Tentang</a></li>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="#">Kategori</a>
                 
                  <ul class="sub-menu">
                    <?php foreach ($datakategori as $key => $value) : ?>
                      <li><a href="kategori.php?id=<?php echo $value["idkategori"] ?>" class="dropdown-item"><?php echo $value["kategori"] ?></a>
                      <?php endforeach ?>
                  </ul>

                </li>

                <?php
                include 'koneksi.php';
                if (isset($_SESSION["akun"])) : ?>
                  <?php
                  $idakun = $_SESSION["akun"]['idakun'];
                  $ambil = $koneksi->query("SELECT *FROM akun WHERE idakun='$idakun'");
                  $pecah = $ambil->fetch_assoc(); ?>

                  <li><a href="#" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Akun</a>
                    <ul class="sub-menu">
                      <li><a href="riwayat.php">Riwayat orderan</a></li>
                      <li><a href="logout.php">Logout</a></li>
                    </ul>
                  </li>
                  <!-- Notifikasi untuk Pelanggan -->
                  <li>
                    <a href="#" id="dropdownNotifikasiPelanggan">
                      <i class="fas fa-bell fa-fw"></i>
                      <?php
                      // Ambil ID akun pelanggan dari sesi login
                      $idakun = $_SESSION['akun']['idakun'];

                      // Hitung jumlah notifikasi untuk pelanggan berdasarkan status orderan
                      $notifikasi_query_pelanggan = "SELECT COUNT(*) as jumlah FROM orderan WHERE idakun = '$idakun' AND status IN ('Pesanan Di Tolak', 'Barang Di Kemas', 'Barang Di Kirim', 'Pesanan Sampai Ke Lokasi Pemesan')";
                      $notifikasi_result_pelanggan = $koneksi->query($notifikasi_query_pelanggan);
                      $notifikasi_data_pelanggan = $notifikasi_result_pelanggan->fetch_assoc();
                      $notifikasi_count_pelanggan = $notifikasi_data_pelanggan['jumlah'];
                      ?>
                      <?php if ($notifikasi_count_pelanggan > 0) : ?>
    <span id="notifikasiBadge" class="badge badge-danger badge-counter"><?= $notifikasi_count_pelanggan ?></span>
  <?php endif; ?>
                    </a>
                    <ul class="sub-menu">
                      <?php if ($notifikasi_count_pelanggan > 0) : ?>
                        <?php
                        // Ambil notifikasi untuk pelanggan berdasarkan idakun
                        $notifikasi_pelanggan_query = "SELECT * FROM orderan WHERE idakun = '$idakun' AND status IN ('Pesanan Di Tolak', 'Barang Di Kemas', 'Barang Di Kirim', 'Pesanan Sampai Ke Lokasi Pemesan') ORDER BY tanggalbeli DESC";
                        $notifikasi_pelanggan_result = $koneksi->query($notifikasi_pelanggan_query);
                        while ($row = $notifikasi_pelanggan_result->fetch_assoc()) :
                        ?>
                          <li>
                            <a href="riwayat.php">
                              Pesanan #<?= $row['idorderan'] ?> telah <b><?= $row['status'] ?></b>.
                              <div class="small text-gray-500"><?= tanggal($row['tanggalbeli']); ?></div>
                            </a>
                          </li>
                        <?php endwhile; ?>
                      <?php else : ?>
                        <li><a class="text-center small text-gray-500">Tidak ada notifikasi</a></li>
                      <?php endif; ?>
                    </ul>
                  </li>
                  <li><a href="keranjang.php"><i class="fa fa-shopping-cart"></i></a></li>

                <?php else : ?>
                  <li><a href="login.php">Login</a></li>
                  <li><a href="keranjang.php"><i class="fa fa-shopping-cart"></i></a></li>
                 <?php endif ; ?>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  