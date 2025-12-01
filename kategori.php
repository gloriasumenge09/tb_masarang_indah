<?php
session_start();
include 'koneksi.php';

?>

<?php include 'header.php';
$kategori = $_GET["id"];


$semuadata = array();
$ambil = $koneksi->query("SELECT*FROM produk WHERE idkategori LIKE '%$kategori%'");
while ($pecah = $ambil->fetch_assoc()) {
	$semuadata[] = $pecah;
}
?>
<?php
$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
	$datakategori[] = $tiap;
}
?>
<?php $am = $koneksi->query("SELECT * FROM kategori where idkategori='$kategori'");
$pe = $am->fetch_assoc()
?>


<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<h1><?php echo $pe["kategori"] ?></h1>
				</div>
			</div>
		</div>
	</div>
</div>
<br><br>

<div class="product-section mt-150 mb-150">
	<div class="container">
		<div class="row ">
			<?php foreach ($semuadata as $key => $perproduk) : ?>
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
			<?php endforeach ?>
		</div>
	</div>
</div>


<?php
include 'footer.php';
?>