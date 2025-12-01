<?php include 'header.php'; ?>
<div class="section-header">
    <h1>Analisis Apriori</h1>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-5">
                    <div class="col-sm-12">
                        <?php
                        echo "<pre>";
                        echo "\r\n<h1 style=text-align:center>Daftar Item</h1>\r\n";
                        ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-bordered">
                                <?php
                                echo " <tr><td>Daftar Item</td></tr>";
                                if ($result = $koneksi->query("select produk from produk", MYSQLI_USE_RESULT)) {
                                    //$item = $result->fetch_all();

                                    while ($i = $result->fetch_row()) {
                                        $item[] = $i[0];

                                        echo " <tr><td> " . $i[0] . "</td></tr>";
                                    }
                                    $result->close();
                                }

                                ?>
                            </table>
                        </div>
                        <?php
                        echo "</pre>";
                        ?>
                    </div>
                    <div class="col-sm-12">
                        <?php
                        echo "<pre>";
                        echo "\r\n<h1 style=text-align:center>Transaksi</h1>\r\n";
                        ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-bordered">
                                <?php
                                echo " <tr><td>Item Set</td></tr>";
                                if ($result = $koneksi->query("select group_concat(produk.produk separator ',')
    from orderanproduk left join produk 
	 on (orderanproduk.idproduk = produk.idproduk)
	 group by orderanproduk.idorderan", MYSQLI_USE_RESULT)) {
                                    //$belian = $result->fetch_all();
                                    $z = 0;
                                    while ($b = $result->fetch_row()) {
                                        $belian[] = $b[0];

                                        echo " <tr><td> " . $b[0] . "</td></tr>";
                                        $z++;
                                    }


                                    $result->close();
                                }
                                echo "</table></div>";
                                echo "</pre>";
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-sm-12">
                            <?php
                            $koneksi->close();



                            $item1 = count($item) - 1; // minus 1 from count
                            $item2 = count($item);
                            $item3 = count($item);
                            echo "<pre>";
                            echo "\r\n<h1 style=text-align:center>Step 1 : Gabungan 1 Item</h1>\r\n";
                            // MENDAPATKAN JUMLAH BARANG
                            ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-bordered">
                                    <?php
                                    echo " <tr> <td>Nama Barang</td><td> Support Count</td><td>Support</td></tr>";
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
                                        echo " <tr> <td>$value </td><td> " . $total_per_item[$value] . "</td><td> " . $spr[$value] . "%</td></tr>";
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <?php
                            // MENDAPAT JUMLAH GABUNGAN
                            echo "<pre>";
                            echo "\r\n<h1 style=text-align:center>Step 2 : Gabungan 2 Item</h1>\r\n";
                            ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-bordered">
                                    <?php
                                    echo "<tr> <td>Item Set</td><td> Support Count</td><td>Support</td></tr>";
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
                                                echo " <tr> <td>$item_pair </td><td> " . $item_array[$item_pair] . "</td><td> " . $spr[$item_pair] . "%</td></tr>";
                                            }
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-sm-12">
                            <?php
                            // MENDAPAT JUMLAH GABUNGAN
                            echo "<pre>";
                            echo "\r\n<h1 style=text-align:center>Step 3 : Jumlah Gabungan 3 Item</h1>\r\n";
                            ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-bordered">
                                    <?php
                                    echo "<tr> <td>Item Set</td><td> Support Count</td><td>Support</td></tr>";
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
                                                    echo " <tr> <td>$item_pair33 </td><td> " . $item_array33[$item_pair33] . "</td><td> " . $spr33[$item_pair33] . "%</td></tr>";
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
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
                                        if ($lift_ratio < 5 && $in_percent > 40 && $in_percent != 100) {
                                            echo "<tr><td>$ia_key --> $item_name</td> <td> " . $in_percent . "%</td></tr>";
                                        }
                                    }
                                }
                            }
                            echo "</table></div>";
                            echo "</pre>";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>