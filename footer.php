<div class="footer-area">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="footer-box about-widget">
					<h2 class="widget-title">Tentang Kami</h2>
					<p>TB. Masarang Indah merupakan pusat penjualan produk berkualitas dan terpercaya.</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="footer-box get-in-touch">
					<h2 class="widget-title">Kontak Kami</h2>
					<ul>
						<li>Jln. Pasar Atas Tondano
							Rinegetan, Tondano Barat, Kab. Minahasa, Sulawesi Utara</li>
							<!-- Tambahkan ini di <head> -->
							<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

							<!-- Tautan dengan ikon -->
							<a href="https://wa.me/628128524370" target="_blank" style="text-decoration:none; color:#C0C0C0; font-size:15px;">
							<i class="fab fa-whatsapp"></i> 0812-8524-370
							</a>

					</ul>
				</div>
			</div>
			<div class="col-md-4">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.7906094683626!2d124.9040847741215!3d1.3004865617342845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x328715a59436ac8d%3A0x2a37c9b8f1befb6f!2sToko%20Masarang%20Indah!5e0!3m2!1sid!2sid!4v1732266592712!5m2!1sid!2sid" width="125%" height="300px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
		</div>
	</div>
</div>
<div class="copyright">
	<div class="container">
		<div class="center">
			<div class="col-lg-6 col-md-12">
			<strong> <a href="https://maps.app.goo.gl/45mFYdqLp5DcZiJn6" target="_blank"> &copy; 2025. All Right Reserved. TB Masarang Indah</a></strong>
			</div>
		</div>
	</div>
</div>

<script src="assets/js/jquery-1.11.3.min.js"></script>
<!-- bootstrap -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- count down -->
<script src="assets/js/jquery.countdown.js"></script>
<!-- isotope -->
<script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
<!-- waypoints -->
<script src="assets/js/waypoints.js"></script>
<!-- owl carousel -->
<script src="assets/js/owl.carousel.min.js"></script>
<!-- magnific popup -->
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<!-- mean menu -->
<script src="assets/js/jquery.meanmenu.min.js"></script>
<!-- sticker js -->
<script src="assets/js/sticker.js"></script>
<!-- main js -->
<script src="assets/js/main.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    $("#dropdownNotifikasiPelanggan").on("click", function (e) {
      e.preventDefault();

      // Hapus elemen badge jumlah notifikasi
      $("#notifikasiBadge").fadeOut();

      // Kirim AJAX ke server untuk mengupdate status notifikasi
      $.ajax({
        url: "update_notifikasi.php", // Buat file ini untuk mengupdate status notifikasi
        type: "POST",
        data: { idakun: <?= json_encode($idakun) ?> },
        success: function (response) {
          console.log("Notifikasi diperbarui.");
        },
        error: function () {
          console.log("Gagal memperbarui notifikasi.");
        }
      });
    });
  });
</script>

</body>

</html>