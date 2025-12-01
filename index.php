<?php
session_start();
include 'koneksi.php';
?>

<?php include 'header.php'; ?>


<div class="homepage-slider">
	<div class="single-homepage-slider homepage-bg-1">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">Selamat Datang Di TB. Masarang Indah</p>
							<h1>Toko Alat dan Bahan Bangunan</h1>
							<div class="hero-btns">
							<a href="produk.php" class="boxed-btn">Belanja Sekarang</a>
							<a href="kontak.php" class="bordered-btn">Kontak Kami</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="single-homepage-slider homepage-bg-2">
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">TB. Masarang Indah</p>
							<h1>Temukan Alat dan Bahan Bangunan Yang Pasti Berkualitas Di Toko Kami</h1>
							<div class="hero-btns">
								<a href="produk.php" class="boxed-btn">Belanja Sekarang</a>
								<a href="kontak.php" class="bordered-btn">Kontak Kami</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="product-section mt-150 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="section-title">
					<h3><span class="orange-text">Produk</span> Terbaru</h3>
				</div>
			</div>
		</div>
		<div class="row">
			<?php $ambil = $koneksi->query("SELECT *FROM produk LEFT JOIN kategori ON produk.idkategori=kategori.idkategori order by idproduk desc limit 3"); ?>
			<?php while ($perproduk = $ambil->fetch_assoc()) { ?>
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item" style="padding-left: 10px;padding-right: 10px">
						<div class="product-image">
							<a href="detail.php?id=<?php echo $perproduk['idproduk']; ?>"><img src="foto/<?php echo $perproduk['foto'] ?>" width="100%" style="height: 200px;object-fit:cover"></a>
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
<div class="abt-section mb-150">
	<div class="container">
		<div class="row">
			<div class="col-md-6 my-auto">
				<img src="foto/bahan2.jpg">
			</div>
			<div class="col-md-6">
				<div class="abt-text">
					<h2>We Are <span class="orange-text">TB. Masarang Indah</span></h2>
					<p>TB. Masarang Indah merupakan penyedia bahan bangunan yang sangat lengkap yang berlokasi di Kota Tondano, Minahasa dengan harga yang terjangkau.</b> Karena perkembangan pembangunan yang begitu pesat, kami sadar bahwa kebutuhan setiap konsumen menjadi lebih bervariasi. Yang pastinya kami memberikan produk yang berkualitas dan terpercaya.
					<p>Dengan beragam penawaran menarik yang sayang untuk dilewatkan. Kami memberikan keamanan dan kenyamanan berbelanja online bagi konsumen. Rasakan sendiri kemudahan serta kepuasan belanja bahan bangunan di tempat kami.
					</p>
					<a href="tentang.php" class="boxed-btn mt-4">Selengkapnya</a>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="shop-banner">
	<div class="container">
		<h3 class="text-white">Kualitas No 1<br> Bahan berkualitas dan Terpercaya...</h3>
		<br>
		<a href="produk.php" class="cart-btn btn-lg">Belanja Sekarang</a>
	</div>
</section>
<?php
include 'footer.php';
?>