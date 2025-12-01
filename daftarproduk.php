<?php include 'header.php'; ?>
<div class="section-header">
	<h1>Daftar Produk</h1>
</div>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<a href="tambahproduk.php" class="btn-sm btn-primary">Tambah Produk</a>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-hover" id="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Kategori</th>
								<th>Harga</th>
								<th>Berat (*KG)</th>
								<th>Foto</th>
								<th>Stok</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$nomor = 1;
							$ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.idkategori=kategori.idkategori ORDER BY produk.produk ASC"); 
							while ($pecah = $ambil->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $pecah['produk'] ?></td>
									<td><?php echo $pecah['kategori'] ?></td>
									<td><?php echo $pecah['harga'] ?></td>
									<td><?php echo $pecah['berat'] ?> KG</td>
									<td>
										<img src="../foto/<?php echo $pecah['foto'] ?>" width="100px">
									</td>
									<td><?php echo $pecah['stok'] ?></td>
									<td>
										<a href="ubahproduk.php?id=<?php echo $pecah['idproduk']; ?>" class="btn btn-warning m-1">Ubah</a>
										<a href="hapusproduk.php?id=<?php echo $pecah['idproduk']; ?>" class="btn btn-danger m-1" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
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
