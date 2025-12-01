<?php include 'header.php'; ?>
<div class="section-header">
	<h1>Daftar Akun Pelanggan</h1>
</div>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-hover" id="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Email</th>
								<th>No. HP</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor = 1; ?>
							<?php $ambil = $koneksi->query("SELECT * FROM akun"); ?>
							<?php while ($pecah = $ambil->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $pecah['nama'] ?></td>
									<td><?php echo $pecah['email'] ?></td>
									<td><?php echo $pecah['nohp'] ?></td>
									<td>
										<a href="hapuspelanggan.php?id=<?php echo $pecah['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
									</td>
								</tr>
								<?php $nomor++; ?>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>