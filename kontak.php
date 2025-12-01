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
                    <h1>Kontak Kami</h1>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- contact form -->
<div class="contact-from-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="contact-form-wrap">
                    <div class="contact-form-box">
                        <h4><i class="fas fa-map"></i> Alamat </h4>
                        <p>Jln. Rinegetan, Kec. Tondano Barat, Kabupaten Minahasa, Sulawesi Utara </p>
                    </div>
                    <div class="contact-form-box">
                        <h4><i class="far fa-clock"></i> Jam Operasional</h4>
                        <p>Senin - Sabtu : 8.00 - 18.00 WIB <br> Minggu : -/- Tutup </p>
                    </div>
                    <div class="contact-form-box">
                        <h4><i class="fas fa-address-book"></i> Kontak</h4>
                        <!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tautan Sosial Media</title>

  <!-- Font Awesome untuk ikon -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-..."
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />

  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 0px;
      background-color: #f9f9f9;
    }

    .social-links {
      display: flex;
      gap: 15px;
    }

    .social-button {
      display: inline-flex;
      align-items: center;
      padding: 10px 18px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
      color: white;
      transition: background 0.3s ease;
    }

    .social-button i {
      margin-right: 10px;
    }

    .facebook {
      background-color: #1877f2;
    }

    .facebook:hover {
      background-color: #145dbf;
    }

    .whatsapp {
      background-color: #25d366;
    }

    .whatsapp:hover {
      background-color: #1ebe5d;
    }
  </style>
</head>
<body>

  <div class="social-links">
    <a
      href="https://www.facebook.com/share/1C7KB5FsBk/"
      class="social-button facebook"
      target="_blank"
    >
      <i class="fab fa-facebook-f"></i> Masarang Indah
    </a>

    <a
      href="https://wa.me/628128524370"
      class="social-button whatsapp"
      target="_blank"
    >
      <i class="fab fa-whatsapp"></i> 0812-8524-370
    </a>
  </div>

</body>
</html>
   
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.7906094683594!2d124.90408477302647!3d1.3004865617365746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x328715a59436ac8d%3A0x2a37c9b8f1befb6f!2sToko%20Masarang%20Indah!5e0!3m2!1sid!2sid!4v1724774396115!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
<!-- end contact form -->


<?php
include 'footer.php';
?>