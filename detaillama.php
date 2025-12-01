<?php
session_start();
include 'koneksi.php';
?>
<?php
$idproduk = $_GET["id"];
$ambil = $koneksi->query("SELECT*FROM produk WHERE idproduk='$idproduk'");
$detail = $ambil->fetch_assoc();
$namaproduk = $detail['produk'];
$kategori = $detail["idkategori"];
?>
<?php include 'header.php'; ?>


<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <h1>Produk Detail</h1>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- single product -->
<div class="single-product mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="single-product-img">
                    <img src="foto/<?php echo $detail["foto"]; ?>" alt="">
                </div>
            </div>
            <div class="col-md-7">
                <div class="single-product-content">
                    <h3><?php echo $detail["produk"] ?></h3>
                    <p class="single-product-pricing"><span>Rp</span><?php echo number_format($detail["harga"]); ?></p>
                    <p><?php echo $detail["deskripsi"]; ?></p>
                    <div class="single-product-form">
                        <form method="post">
                            <div class="form-group">
                                <label>Beli Produk</label>
                                <input type="text" placeholder="Jumlah" min="1" class="form-control" name="jumlah" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" max="<?php echo number_format($detail["stok"]); ?>" required>
                                <br>
                                <button type="submit" class="btn btn-warning btn-block" name="beli"><i class="fas fa-shopping-cart"></i> Beli</button>
                            </div>
                            <?php
                            if (isset($_POST["beli"])) {
                                $jumlah = $_POST["jumlah"];
                                $_SESSION["keranjang"][$idproduk] = $jumlah;
                                echo "<script> alert('Produk Masuk Ke Keranjang');</script>";
                                echo "<script> location ='keranjang.php';</script>";
                            }
                            ?>
                        </form>
                        <?php
                        if (isset($_POST["beli"])) {
                            $jumlah = $_POST["jumlah"];
                            $_SESSION["keranjang"][$idproduk] = $jumlah;
                            echo "<script> alert('Produk Masuk Ke Keranjang');</script>";
                            echo "<script> location ='keranjang.php';</script>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if ($result = $koneksi->query("select produk from produk", MYSQLI_USE_RESULT)) {
            while ($i = $result->fetch_row()) {
                $item[] = $i[0];
            }
            $result->close();
        }

        if ($result = $koneksi->query("select group_concat(produk.produk separator ',')
    from orderanproduk left join produk 
	 on (orderanproduk.idproduk = produk.idproduk)
	 group by orderanproduk.idorderan", MYSQLI_USE_RESULT)) {
            $z = 0;
            while ($b = $result->fetch_row()) {
                $belian[] = $b[0];
                $z++;
            }


            $result->close();
        }
        $item1 = count($item) - 1; // minus 1 from count
        $item2 = count($item);
        $item3 = count($item);
        foreach ($item as $value) {
            $total_per_item[$value] = 0;
            $support[$value] = 0;
            foreach ($belian as $item_belian) {
                if (strpos($item_belian, $value) !== false) {
                    $total_per_item[$value]++;
                    $support[$value]++;
                }
            }
            $spr[$value] = round($support[$value] / $z * 100, 2);
        }
        for ($i = 0; $i < $item1; $i++) {
            for ($j = $i + 1; $j < $item2; $j++) {
                $item_pair = $item[$i] . '|' . $item[$j];
                $item_array[$item_pair] = 0;
                $sprt[$item_pair] = 0;
                foreach ($belian as $item_belian) {
                    if ((strpos($item_belian, $item[$i]) !== false) && (strpos($item_belian, $item[$j]) !== false)) {
                        $item_array[$item_pair]++;
                        $sprt[$item_pair]++;
                    }
                    $spr[$item_pair] = round($sprt[$item_pair] / $z * 100, 2);
                }
                if ($item_array[$item_pair] > 0) {
                }
            }
        }
        for ($i = 0; $i < $item1; $i++) {
            for ($j = $i + 1; $j < $item2; $j++) {
                for ($k = $j + 1; $k < $item3; $k++) {
                    $item_pair33 = $item[$i] . '|' . $item[$j] . '|' . $item[$k];
                    $item_array33[$item_pair33] = 0;
                    $sprt33[$item_pair33] = 0;

                    foreach ($belian as $item_belian33) {
                        if ((strpos($item_belian33, $item[$i]) !== false) && (strpos($item_belian33, $item[$j]) !== false) && (strpos($item_belian33, $item[$k]) !== false)) {
                            $item_array33[$item_pair33]++;
                            $sprt33[$item_pair33]++;
                        }

                        $spr33[$item_pair33] = round($sprt33[$item_pair33] / $z * 100, 2);
                    }

                    if ($item_array33[$item_pair33] > 0) {
                    }
                }
            }
        }
        ?>
        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
                <h3 class="text-center">Rekomendasi produk yang sering dibeli dengan produk <span class="text-success"><?= $namaproduk ?></span>
                    <span class="text-danger">menggunakan algoritma Apriori</span>
                </h3>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-sm-12">
                <?php
                echo "<pre>";
                echo "\r\n<h1 style=text-align:center>Step 4 : Association Rule</h1>\r\n";
                echo "<br>Hasil untuk Confidence > 50%";
                echo "<div class='table-responsive'><table class=table border=\2\>";
                echo "<tr><td>Item Set</td><td>Confidence</td></tr>";
                $dataset = [];
                $arraykedua = [];
                $dataprodukrekomendasi = [];
                foreach ($item_array as $ia_key => $ia_value) {
                    $theitems = explode('|', $ia_key);
                    for ($x = 0; $x < count($theitems); $x++) {
                        $item_name = $theitems[$x];
                        $item_total = $total_per_item[$item_name];

                        if ($item_total > 0) {
                            $in_float = $ia_value / $item_total;
                            $in_percent = round($in_float * 100, 2);
                            $alt_item = $theitems[($x + 1) % count($theitems)];
                            $benc_marc = round(($total_per_item[$theitems[0]] + $total_per_item[$theitems[1]]) / $z * 100, 2);
                            // $lift_ratio = round($in_percent / $spr[$theitems[0]], 2);
                            if ($spr[$theitems[0]] == 0) {
                                $lift_ratio = round($in_percent / 1, 2);
                            } else {
                                $lift_ratio = round($in_percent / $spr[$theitems[0]], 2);
                            }
                            if ($lift_ratio < 5 && $in_percent > 50 && $in_percent != 100) {
                                echo "<tr><td>$ia_key</td> <td> " . $in_percent . "%</td></tr>";
                                $explode = explode("|", $ia_key);
                                if (in_array($namaproduk, $explode)) {
                                    $cek = array_diff($explode, [$namaproduk]);
                                    $arraykedua[] = $cek;
                                }
                            }
                        }
                    }
                }
                echo '<br><br>';
                echo "</table></div>";
                echo "</pre>";
                $hasilprodukrekomendasi = array_reduce($arraykedua, 'array_merge', array());
                $produkrekomendasi = array_unique($hasilprodukrekomendasi);
                ?>
                <div class="row product-lists">
                    <?php
                    foreach ($produkrekomendasi as $hasilproduk) {
                        // echo $hasilproduk;
                    ?>
                        <?php
                        $ambilrekomendasi = $koneksi->query("SELECT *FROM produk limit 1");
                        $rekomendasi = $ambilrekomendasi->fetch_assoc(); ?>
                        <div class="col-lg-4 col-md-6 text-center strawberry">
                            <div class="single-product-item" style="padding-left: 10px;padding-right: 10px">
                                <div class="product-image">
                                    <a href="detail.php?id=<?php echo $rekomendasi['idproduk']; ?>"><img src="foto/<?php echo $rekomendasi['foto'] ?>" width="100%" style="height: 200px;object-fit:cover"></a>
                                </div>
                                <h6><?php echo $rekomendasi['produk'] ?></h6>
                                <p class="product-price"><span>Rp </span><?php echo number_format($rekomendasi['harga']) ?></p>
                                <a href="detail.php?id=<?php echo $rekomendasi['idproduk']; ?>" class="cart-btn"><i class="fas fa-shopping-cart"></i> Detail</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>