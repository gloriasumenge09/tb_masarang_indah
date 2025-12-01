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
                    <h1>Produk</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form Pencarian -->
<div class="container mt-4">
    <form method="GET" action="">
        <div class="row">
            <div class="col-md-8">
                <input type="text" name="keyword" class="form-control" placeholder="Cari produk..." value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">Cari Produk</button>
            </div>
        </div>
    </form>
</div>


<!-- products -->
<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row product-lists">
            <?php 
            // Ambil keyword pencarian jika ada
            $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

            // Query pencarian produk berdasarkan nama produk
            $sql = "SELECT * FROM produk 
                    LEFT JOIN kategori ON produk.idkategori = kategori.idkategori 
                    WHERE produk.produk LIKE '%$keyword%' 
                    ORDER BY produk.produk ASC";
                    
            $ambil = $koneksi->query($sql);

            // Jika tidak ada hasil pencarian
            if ($ambil->num_rows == 0) {
                echo "<div class='col-12 text-center'><p>Produk tidak ditemukan.</p></div>";
            }

            while ($perproduk = $ambil->fetch_assoc()) { ?>
                <div class="col-lg-4 col-md-6 text-center strawberry">
                    <div class="single-product-item" style="padding-left: 10px;padding-right: 10px">
                        <div class="product-image">
                            <a href="detail.php?id=<?php echo $perproduk['idproduk']; ?>">
                                <img src="foto/<?php echo $perproduk['foto'] ?>" width="100%" style="height: 200px;object-fit:cover">
                            </a>
                        </div>
                        <h6><?php echo $perproduk['produk'] ?></h6>
                        <p class="product-price"><span>Rp </span><?php echo number_format($perproduk['harga']) ?></p>
                        <a href="detail.php?id=<?php echo $perproduk['idproduk']; ?>" class="cart-btn"><i class="fas fa-shopping-cart"></i> Detail</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- end products -->

<?php
include 'footer.php';
?>
