<?php
session_start();
include 'koneksi.php';
?>

<?php include 'header.php'; ?>


<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <h1>Tentang Kami</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="featured-text">
                    <h2 class="pb-3">Kenapa <span class="orange-text">TB. Masarang Indah</span></h2>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 mb-4 mb-md-5">
                            <div class="list-box d-flex">
                                <div class="list-icon">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                                <div class="content">
                                    <h3>Pesanan Cepat Dikirim</h3>
                                    <p>Pesanan anda akan cepat dikirim oleh kami</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-5 mb-md-5">
                            <div class="list-box d-flex">
                                <div class="list-icon">
                                    <i class="fas fa-money-bill-alt"></i>
                                </div>
                                <div class="content">
                                    <h3>Best Price</h3>
                                    <p>Kami adalah toko bangunan terpercaya yang menawarkan harga terbaik dan kualitas unggul untuk semua kebutuhan material Anda.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-5 mb-md-5">
                            <div class="list-box d-flex">
                                <div class="list-icon">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <div class="content">
                                    <h3>Produk Lengkap</h3>
                                    <p>Mulai dari semen, besi, keramik, cat, hingga alat-alat bangunan lainnya.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="list-box d-flex">
                                <div class="list-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="content">
                                    <h3>Kualitas Terjamin</h3>
                                    <p>Semua produk kami berasal dari merek terpercaya.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="shop-banner">
    <div class="container">
        <h3>Produk <br>Berkualitas dan Terpercaya<span class="orange-text"></span></h3>
        <br>
        <a href="produk.php" class="cart-btn btn-lg">Belanja Sekarang</a>
    </div>
</section>

<!-- end featured section -->


<?php
include 'footer.php';
?>