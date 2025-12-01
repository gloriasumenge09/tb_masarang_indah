<?php include 'header.php'; ?>
<div class="section-header">
	<h1>Daftar Kategori</h1>
</div>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<a href="tambahkategori.php" class="btn-sm btn-primary">Tambah Kategori</a>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-hover" id="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Kategori</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor = 1;
							$ambil = $koneksi->query("SELECT * FROM kategori");
							while ($data = $ambil->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $nomor ?></td>
									<td><?php echo $data["kategori"] ?></td>
									<td>
										<a href="ubahkategori.php?id=<?php echo $data['idkategori']; ?>" class="btn btn-warning btn-sm">Ubah</a>
										<a href="hapuskategori.php?id=<?php echo $data['idkategori']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
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