<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION["akun"])) {
	echo "<script> alert('Anda belum login');</script>";
	echo "<script> location ='login.php';</script>";
}
?>

<?php include 'header.php'; ?>

<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<h1>Riwayat</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<br><br>

<section id="home-section" class="hero">
	<div class="container mt-4">
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="cart-list table-responsive">
					<table class="table">
						<thead>
							<tr class="text-center">
								<th>No</th>
								<th>Tanggal</th>
								<th>Daftar Produk</th>
								<th>Total</th>
								<th>Aksi</th>
								<th>Nota</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor = 1;
							$idakun = $_SESSION["akun"]['idakun'];
							$ambil = $koneksi->query("SELECT *, orderan.idorderan as idorderanfix FROM orderan left join pembayaran on orderan.idorderan = pembayaran.idorderan WHERE orderan.idakun='$idakun' order by orderan.tanggalbeli desc, orderan.idorderan desc");
							while ($pecah = $ambil->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo tanggal($pecah['tanggalbeli']) ?></td>
									<td>
										<?php $ambildetail = $koneksi->query("SELECT * FROM orderanproduk WHERE idorderan='$pecah[idorderanfix]'") or die(mysqli_error($koneksi)); ?>
										<?php while ($detail = $ambildetail->fetch_assoc()) {
										?>
											<?= $detail['nama'] . '<b> x ' . $detail['jumlah'] . '</b><br><br>' ?>
										<?php } ?>
									</td>
									<td>Rp. <?php echo number_format($pecah["totalbeli"] + $pecah["ongkir"]); ?></td>
									<td align="center">
										<?php if ($pecah['status'] == "Belum Bayar") {
											$deadline = date('Y-m-d H:i', strtotime($pecah['waktu'] . ' +1 day'));
											$harideadline = date('Y-m-d', strtotime($pecah['waktu'] . ' +1 day'));
											$jamdeadline = date('H:i', strtotime($pecah['waktu'] . ' +1 day'));
											if (date('Y-m-d H:i') >= $deadline) {
												echo 'Waktu pembayaran<br>telah habis';
											} else { ?>
												<a href="pembayaran.php?id=<?php echo $pecah["idorderanfix"] ?>" class="btn btn-warning">Lakukan Pembayaran Sebelum<br><?= tanggal($harideadline) . ' - Jam ' . $jamdeadline ?></a>
											<?php }
										} elseif ($pecah['status'] == "Sudah Upload Bukti Pembayaran") { ?>
											<a class="btn btn-warning text-white">Menunggu Konfirmasi Admin</a>
											<br>
											<br>
											<img width="150px" src="foto/<?= $pecah['bukti'] ?>" alt="">
										<?php } elseif ($pecah['status'] == "Barang Di Kirim") { ?>
											<a class="btn btn-warning text-white">Barang Anda Sedang Di Kirim, Mohon Di Tungggu</a>
											<br><br>
											<p><a target="_blank" href="https://cekresi.com">No Resi : <?= $pecah['noresi'] ?></a></p>
											<br>
											<br>
											<img width="150px" src="foto/<?= $pecah['bukti'] ?>" alt="">
										<?php } elseif ($pecah['status'] == "Pesanan Sampai Ke Lokasi Pemesan") { ?>
											<a data-toggle="modal" data-target="#selesai<?= $nomor ?>" class="btn btn-success text-white">Konfirmasi Selesai</a>
											<br>
											<br>
											<img width="150px" src="foto/<?= $pecah['bukti'] ?>" alt="">
										<?php } elseif ($pecah['status'] == "Selesai") { ?>
											<b>Selesai</b>
											<br>
											<p><a target="_blank" href="https://cekresi.com">No Resi : <?= $pecah['noresi'] ?></a></p>
											<br>
											<br>
											<img width="150px" src="foto/<?= $pecah['bukti'] ?>" alt="">
										<?php } elseif ($pecah['status'] == "Pesanan Di Tolak") { ?>
											<a class="btn btn-danger text-white">Pesanan Anda Di Tolak</a>
											<br>
											<br>
											<img width="150px" src="foto/<?= $pecah['bukti'] ?>" alt="">
										<?php } ?>
									</td>
									<td>
										<a class="btn btn-success" target="_blank" href="nota.php?id=<?= $pecah['idorderanfix'] ?>">Download Nota</a>
									</td>
								</tr>
								<?php $nomor++; ?>
							<?php  } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<br><br><br>

<?php
$no = 1;
$idakun = $_SESSION["akun"]['idakun'];
$ambil = $koneksi->query("SELECT *, orderan.idorderan as idorderanfix FROM orderan left join pembayaran on orderan.idorderan = pembayaran.idorderan WHERE orderan.idakun='$idakun' order by orderan.tanggalbeli desc, orderan.idorderan desc");
while ($pecah = $ambil->fetch_assoc()) { ?>
	<div class="modal fade" id="selesai<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pesanan Selesai</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post">
					<div class="modal-body">
						<h5>Apakah anda yakin ingin mengkonfirmasi pesanan telah selesai ?</h5>
					</div>
					<div class="modal-footer">
						<input type="hidden" class="form-contol" value="<?= $pecah['idorderanfix'] ?>" name="idorderan">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<button type="submit" name="selesai" value="selesai" class="btn btn-primary">Konfirmasi</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php
	$no++;
} ?>
<?php
if (isset($_POST["selesai"])) {
	$koneksi->query("UPDATE orderan SET status='Selesai'
		WHERE idorderan='$_POST[idorderan]'");
	echo "<script>alert('Pesanan berhasil di konfirmasi selesai')</script>";
	echo "<script>location='riwayat.php';</script>";
}
?>
<?php
include 'footer.php';
?>