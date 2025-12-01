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
					<h1>Checkout</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<br><br>

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
								<th>Harga</th>
								<th>Jumlah Beli</th>
								<th>SubHarga</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor = 1; ?>
							<?php $totalberat = 0; ?>
							<?php $totalbelanja = 0; ?>
							<?php foreach ($_SESSION["keranjang"] as $idproduk => $jumlah) : ?>
								<?php
								$ambil = $koneksi->query("SELECT * FROM produk 
						        WHERE idproduk='$idproduk'");
								$pecah = $ambil->fetch_assoc();
								$totalharga = $pecah["harga"] * $jumlah;
								$subberat = $pecah["berat"] * $jumlah;
								$totalberat += $subberat; ?>
								<tr class="text-center">
									<td><?php echo $nomor; ?></td>
									<td><?php echo $pecah['produk']; ?></td>
									<td>Rp <?php echo number_format($pecah['harga']); ?></td>
									<td><?php echo $jumlah; ?></td>
									<td>Rp <?php echo number_format($totalharga); ?></td>
								</tr>
								<?php $nomor++; ?>
								<?php $totalbelanja += $totalharga; ?>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<br><br>
	<div class="container mt-4">
		<form method="post">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" readonly value="<?php echo $_SESSION["akun"]['nama'] ?>" class="form-control">
					</div>
					<div class="form-group">
						<label>No. Handphone</label>
						<input type="text" readonly value="<?php echo $_SESSION["akun"]['nohp'] ?>" class="form-control">
					</div>
					<div class="form-group">
						<label>Alamat Pengiriman</label>
						<input type="hidden" name="totalberatnya" value="<?php echo $totalberat ?>">
						<textarea class="form-control" name="lokasi" rows="5" placeholder="Masukkan Alamat"></textarea>
					</div>
					<div class="form-group">
						<label>Kota</label>
						<select name="kota" class="form-control" required id="Sone" onchange="check()">
							<option value="">Pilih Kota</option>
							<option value="Tondano">Tondano</option>
							<option value="Tomohon">Tomohon</option>
							<option value="Manado">Manado</option>
						</select>
					</div>
					<input type="hidden" id="dua" name="dua" value="<?php echo $totalbelanja ?>">
					<div class="form-group">
						<label>Ongkir</label>
						<input class="form-control" name="ongkir" type="text" readonly required id="res">
					</div>
					<div class="form-group">
						<label>Grand Total</label>
						<input class="form-control" id="result" required readonly type="text">
					</div>
					<button class="btn btn-primary float-right pull-right btn-lg" name="checkout">Selesaikan Transaksi</button>
				</div>
			</div>
		</form>
	</div>
</section>
<?php
if (isset($_POST["checkout"])) {
	require_once 'midtrans_config.php';

	$noorderan = date("Ymdhis");
	$idakun = $_SESSION["akun"]["idakun"];
	$tanggalbeli = date("Y-m-d");
	$waktu = date("Y-m-d H:i:s");
	$lokasi = $_POST["lokasi"];
	$totalbeli = $totalbelanja;
	$totalberatnya = $_POST["totalberatnya"];
	$ongkir = $_POST["ongkir"];
	$kota = $_POST["kota"];
	$invoice = date("Ymdhis") . rand(100, 999);

	// Persiapan data customer dan transaksi
	$nama = $_SESSION["akun"]['nama'];
	$email = $_SESSION["akun"]['email'];
	$nohp = $_SESSION["akun"]['nohp'];

	$params = [
		'transaction_details' => [
			'order_id' => $invoice,
			'gross_amount' => (int)$totalbelanja + (int)$ongkir
		],
		'customer_details' => [
			'first_name' => $nama,
			'email' => $email,
			'phone' => $nohp
		]
	];

	// Ambil snap token
	$snapToken = \Midtrans\Snap::getSnapToken($params);

	// Simpan orderan
	$koneksi->query(
		"INSERT INTO orderan(invoice, noorderan, idakun, tanggalbeli, totalbeli, lokasi, totalberat, kota, ongkir, status, waktu, snaptoken)
		VALUES('$invoice', '$noorderan','$idakun', '$tanggalbeli', '$totalbeli', '$lokasi','$totalberatnya','$kota','$ongkir', 'Belum Bayar', '$waktu', '$snapToken')"
	) or die(mysqli_error($koneksi));

	$idorderan = $koneksi->insert_id;

	foreach ($_SESSION['keranjang'] as $idproduk => $jumlah) {
		$ambil = $koneksi->query("SELECT*FROM produk WHERE idproduk='$idproduk'");
		$perproduk = $ambil->fetch_assoc();
		$nama = $perproduk['produk'];
		$harga = $perproduk['harga'];
		$berat = $perproduk['berat'];

		$subberat = $berat * $jumlah;
		$subharga = $harga * $jumlah;

		$koneksi->query("INSERT INTO orderanproduk (idorderan, idproduk, nama, harga, berat, subberat, subharga, jumlah)
			VALUES ('$idorderan','$idproduk', '$nama','$harga','$berat', '$subberat', '$subharga','$jumlah')") or die(mysqli_error($koneksi));

		$koneksi->query("UPDATE produk SET stok=stok - $jumlah WHERE idproduk='$idproduk'") or die(mysqli_error($koneksi));
	}

	unset($_SESSION["keranjang"]);

	// Arahkan ke halaman pembayaran (kamu bisa munculkan Snap popup di riwayat.php)
	echo "<script>location = 'riwayat.php?snaptoken=$snapToken';</script>";
}

?>
<?php
include 'footer.php';
?>

<script>
	$(document).ready(function() {
		$.ajax({
			type: 'post',
			url: 'dataprovinsi.php',
			success: function(hasil_provinsi) {
				$("select[name=nama_provinsi]").html(hasil_provinsi);
			}
		});
		$("select[name=nama_provinsi").on("change", function() {
			var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
			$.ajax({
				type: 'post',
				url: 'datadistrict.php',
				data: 'id_provinsi=' + id_provinsi_terpilih,
				success: function(hasil_distrik) {
					$("select[name=nama_distrik]").html(hasil_distrik);
				}
			});
		});
		$.ajax({
			type: 'post',
			url: 'dataekspedisi.php',
			success: function(hasil_ekspedisi) {
				$("select[name=ekspedisi]").html(hasil_ekspedisi);
			}
		});
		$("select[name=ekspedisi]").on("change", function() {
			var ekspedisi_terpilih = $("select[name=ekspedisi]").val();
			// alert(ekspedisi_terpilih);

			var distrik_terpilih = $("option:selected", "select[name=nama_distrik]").attr("id_distrik");
			// alert(distrik_terpilih)

			var total_berat = $("input[name=total_berat]").val();
			$.ajax({
				type: 'post',
				url: 'datapaket.php',
				data: 'ekspedisi=' + ekspedisi_terpilih + '&distrik=' + distrik_terpilih + '&berat=' + total_berat,
				success: function(hasil_paket) {
					// console.log(hasil_paket);
					$("select[name=nama_paket]").html(hasil_paket);

					$("input[name=namaekspedisi]").val(ekspedisi_terpilih);
				}
			})
		});
		$("select[name=nama_distrik]").on("change", function() {
			var prov = $("option:selected", this).attr("nama_provinsi");
			var dist = $("option:selected", this).attr("nama_distrik");
			var tipe = $("option:selected", this).attr("tipe_distrik");
			var kodepos = $("option:selected", this).attr("kodepos");
			// alert(prov);
			$("input[name=provinsi]").val(prov);
			$("input[name=distrik]").val(dist);
			$("input[name=tipe]").val(tipe);
			$("input[name=kodepos]").val(kodepos);


		});
		$("select[name=nama_paket]").on("change", function() {
			var paket = $("option:selected", this).attr("paket");
			var ongkir = $("option:selected", this).attr("ongkir");
			var etd = $("option:selected", this).attr("etd");
			$("input[name=paket]").val(paket);
			$("input[name=ongkir").val(ongkir);
			$("input[name=estimasi").val(etd);
		})


	});
</script>
<script>
	function check() {
		var val = document.getElementById('Sone').value;
		if (val == 'Minahasa') {
			document.getElementById('res').value = "0";
		} else if (val == 'Tondano') {
			document.getElementById('res').value = "0";
		} else if (val == 'Tomohon') {
			document.getElementById('res').value = "0";
		} else if (val == 'Manado') {
			document.getElementById('res').value = "10000";
		}
		var num1 = document.getElementById("res").value;
		var num2 = document.getElementById("dua").value;
		result = parseInt(num1) + parseInt(num2);
		document.getElementById("result").value = result;

	}
</script>