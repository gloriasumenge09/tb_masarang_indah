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
					<h1>Keranjang</h1>
				</div>
			</div>
		</div>
	</div>
</div>

<section id="home-section" class="hero mb-5">
	<div class="container mt-4">
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="cart-list table-responsive">
					<table class="table">
						<thead>
							<tr class="text-center">
								<th>No</th>
								<th>Produk</th>
								<th>Foto</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th>Total</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor = 1; ?>
							<?php if (!empty($_SESSION["keranjang"])) { ?>
								<?php foreach ($_SESSION["keranjang"] as $idproduk => $jumlah) : ?>
									<?php
									$ambil = $koneksi->query("SELECT * FROM produk 
								WHERE idproduk='$idproduk'");
									$pecah = $ambil->fetch_assoc();
									$totalharga = $pecah["harga"] * $jumlah;
									?>
									<tr class="text-center">
										<td><?php echo $nomor; ?></td>
										<td><?php echo $pecah['produk']; ?></td>
										<td class="image-prod">
											<img src="foto/<?php echo $pecah["foto"]; ?>" width="150px" style="border-radius: 10px">
										</td>
										<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
										<td><?php echo $jumlah; ?></td>
										<td>Rp. <?php echo number_format($totalharga); ?></td>
										<td>
											<a href="hapuskeranjang.php?id=<?php echo $idproduk ?>" class="btn btn-danger btn-xs">Hapus</a>
										</td>
									</tr>
									<?php $nomor++; ?>
							<?php endforeach;
							} ?>
						</tbody>
					</table>
				</div>
				<br><br>
				<div class="float-right pull-right">
					<a href="produk.php" class="btn btn-warning">Tambah Produk Lain</a>
					&nbsp;<a href="checkout.php" class="btn btn-primary">Checkout</a>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
include 'footer.php';
?>