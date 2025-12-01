<?php include 'header.php'; ?>
<div class="section-header">
	<h1>Daftar Order</h1>
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
								<th>Tanggal orderan</th>
								<th>Total orderan</th>
								<th>Status Belanja</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor = 1; ?>
							<?php $ambil = $koneksi->query("SELECT * FROM orderan JOIN akun ON orderan.idakun=akun.idakun order by orderan.tanggalbeli desc, orderan.idorderan desc");; ?>
							<?php while ($pecah = $ambil->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $pecah['nama'] ?></td>
									<td><?= tanggal(date('Y-m-d', strtotime($pecah['tanggalbeli']))) ?></td>
									<td>Rp. <?php echo number_format($pecah['totalbeli'] + $pecah['ongkir']) ?></td>
									<td><?php echo $pecah['status'] == 'Sudah Upload Bukti Pembayaran' ? 'Sudah Bayar' : $pecah['status'] ?></td>
									<td>
										<a href="order.php?id=<?php echo $pecah['idorderan'] ?>" class="btn btn-info">Detail</a>
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