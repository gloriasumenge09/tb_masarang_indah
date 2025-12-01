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
					<h1>Daftar</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<br><br>
<section id="home-section" class="ftco-section">
	<div class="container mt-4">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<form method="post" class="form-horizontal">
					<div class="form-group">
						<label class="control-label">Nama</label>
						<input type="text" name="nama" class="form-control" required>
					</div>
					<div class="form-group">
						<label class="control-label">Alamat</label>
						<textarea class="form-control" name="alamat" rows="5" required></textarea>
					</div>
					<div class="form-group">
						<label class="control-label">No. HP</label>
						<input type="text" name="nohp" required class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Email</label>
						<input type="email" name="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label class="control-label">Password</label>
						<input type="text" name="password" class="form-control" required>
					</div>
					<div class="form-group ">
						<button class="btn btn-primary btn-block" name="daftar">Daftar</button>
					</div>
				</form>
			</div>
		</div>
</section>
<br>



<?php
if (isset($_POST["daftar"])) {
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$alamat = $_POST['alamat'];
	$nohp = $_POST['nohp'];
	$ambil = $koneksi->query("SELECT*FROM akun 
							WHERE email='$email'");
	$yangcocok = $ambil->num_rows;
	if ($yangcocok == 1) {
		echo "<script>alert('Email sudah terdaftar, mohon menggunakan email lainnya')</script>";
		echo "<script>location='daftar.php';</script>";
	} else {
		$koneksi->query("INSERT INTO akun	(nama, email,  password, alamat, nohp, role)
								VALUES('$nama','$email','$password','$alamat','$nohp','Pelanggan')");
		echo "<script>alert('Pendaftaran Berhasil')</script>";
		echo "<script>location='login.php';</script>";
	}
}
?>
<?php
include 'footer.php';
?>