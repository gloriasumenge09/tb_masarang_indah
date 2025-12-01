<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION["akun"])) {
	echo "<script> alert('Anda belum login');</script>";
	echo "<script> location ='login.php';</script>";
	exit();
}
$idorderan = $_GET["id"];
$ambil = $koneksi->query("SELECT*FROM orderan WHERE idorderan='$idorderan'");
$detailorderan = $ambil->fetch_assoc();
$id_beli = $detailorderan["idorderan"];
$id_login = $_SESSION["akun"]["idakun"];
$deadline = date('Y-m-d H:i', strtotime($detailorderan['waktu'] . ' +1 day'));
$harideadline = date('Y-m-d', strtotime($detailorderan['waktu'] . ' +1 day'));
$jamdeadline = date('H:i', strtotime($detailorderan['waktu'] . ' +1 day'));
if (date('Y-m-d H:i') >= $deadline) {
	echo "<script> alert('Waktu pembayaran telah habis');</script>";
	echo "<script> location ='riwayat.php';</script>";
}
?>
<?php include 'header.php'; ?>

<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<h1>Pembayaran</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<br><br>

<section id="home-section" class="ftco-section">
	<div class="container mt-4">
		<div class="row mb-5">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Produk</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th>Total Harga</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor = 1; ?>
							<?php $ambil = $koneksi->query("SELECT * FROM orderanproduk WHERE idorderan='$_GET[id]'"); ?>
							<?php while ($pecah = $ambil->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $pecah['nama']; ?></td>
									<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
									<td><?php echo $pecah['jumlah']; ?></td>
									<td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
								</tr>
								<?php $nomor++; ?>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php
		$ambil = $koneksi->query("SELECT*FROM orderan JOIN akun
	ON orderan.idakun=akun.idakun
	WHERE orderan.idorderan='$_GET[id]'");
		$detail = $ambil->fetch_assoc();
		?>

		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<tr>
							<td>No. HP</td>
							<td><?php echo $detail['nohp']; ?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><?php echo $detail['email']; ?></td>
						</tr>
						<tr>
							<td>Kota</td>
							<td><?php echo $detail['kota']; ?></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td><?php echo $detail['lokasi']; ?></td>
						</tr>
						<tr>
							<td>Tanggal</td>
							<td><?php echo tanggal($detail['tanggalbeli']); ?></td>
						</tr>
						<tr>
							<td>Status</td>
							<td><?php echo $detail['status']; ?></td>
						</tr>
						<tr>
							<td>Total</td>
							<td><?php echo harga($detail['totalbeli']); ?></td>
						</tr>
						<tr>
							<td>Ongkir</td>
							<td><?php echo harga($detail['ongkir']); ?></td>
						</tr>
						<tr>
							<td>Grandtotal</td>
							<td><?php echo harga($detail['ongkir'] + $detail['totalbeli']); ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		
				<div class="alert alert-info">Total Tagihan Anda : <strong>Rp. <?php echo number_format($detailorderan["totalbeli"] + $detailorderan["ongkir"]) ?></strong></div>

				<div class="text-center">
					<button id="pay-button" class="btn btn-primary btn-lg">Bayar Sekarang</button>
				</div>

			</div>
		</div>
	</div>
</section>
<br><br>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-0Vz-I7afUEFy8-oQ"></script>
<script type="text/javascript">
	document.getElementById('pay-button').addEventListener('click', function() {
		snap.pay('<?= $detail['snaptoken'] ?>', {

		});
	});
</script>

<?php
include 'footer.php';
?>