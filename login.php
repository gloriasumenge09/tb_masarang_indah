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
					<h1>Login</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<br><br>

<section id="home-section" class="ftco-section mb-5">
	<div class="container mt-4">
		<div class="row justify-content-center">
			<div class="col-md-5">
				<img width="100%" src="foto/daftar1.jpg">
			</div>
			<div class="col-md-7">
				<form method="post">
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" name="password">
					</div>
					<br>
					<button class="btn btn-primary btn-block" name="simpan">Masuk</button>
				</form>
				<p>Belum mempunyai akun? <a href="daftar.php">Daftar sekarang</a></p>
			</div>
		</div>
	</div>
</section>
<br>



<?php
if (isset($_POST["simpan"])) {
	$email = $_POST["email"];
	$password = $_POST["password"];
	$ambil = $koneksi->query("SELECT * FROM akun
		WHERE email='$email' AND password='$password' limit 1");
	$akunyangcocok = $ambil->num_rows;
	if ($akunyangcocok == 1) {
		$akun = $ambil->fetch_assoc();
		if ($akun['role'] == "Pelanggan") {
			$_SESSION["akun"] = $akun;
			echo "<script> location ='index.php';</script>";
		} elseif ($akun['role'] == "Admin") {
			$_SESSION['akun'] = $akun;
			echo "<script> location ='admin/index.php';</script>";
		}
	} else {
		echo "<script> alert('Anda gagal login, Cek akun anda');</script>";
		echo "<script> location ='login.php';</script>";
	}
}
?>
<?php
include 'footer.php';
?>