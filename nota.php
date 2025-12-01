<?php
function harga($angka)
{
    $hasilharga = "Rp " . number_format($angka, 2, ',', '.');
    return $hasilharga;
}
include('koneksi.php');
function tanggal($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = bulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function bulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT*FROM orderan JOIN akun
ON orderan.idakun=akun.idakun
WHERE orderan.idorderan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>
<html>

<head>
    <title>TB. Masarang Indah</title>
    <style>
        @page {
            margin: 3mm;
        }
    </style>
    <style>
        hr {
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 1px;
        }
    </style>
</head>

<body style='font-family:tahoma; font-size:8pt;padding-top:50px'>
    <table style='width:750; font-size:16pt; font-family:calibri; border-collapse: collapspe;' border='0'>
        <tr>
            <td align="center">
                <center>
                    <font size="6"><b>TB. Masarang Indah</b></font><br>
                    <font size="3"><b>Jln. Rinegetan, Kec.Tondano Barat,<br> Kab.Minahasa, Sulawesi Utara</b>
                    </font><br>
                </center>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <hr style="border-top: 1px solid black;width:660">
    <br>
    <center>
        <table style='width:660; font-size:16pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <tr>
                <td colspan="2">
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td>
                    <span style="font-size:11pt">No. Nota</span>
                </td>
                <td>
                    <span style="font-size:11pt"> : <?= $pecah['noorderan'] ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <span style="font-size:11pt">Tanggal</span>
                </td>
                <td>
                    <span style="font-size:11pt"> : <?= tanggal(date('Y-m-d', strtotime($pecah['tanggalbeli']))) ?></span>
                </td>
            </tr>
            <tr>
                <td width="15%">
                    <span style="font-size:11pt">Nama</span>
                </td>
                <td>
                    <span style="font-size:11pt"> : <?= $pecah['nama'] ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <span style="font-size:11pt">Alamat</span>
                </td>
                <td>
                    <span style="font-size:11pt"> : <?= $pecah['alamat'] ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <span style="font-size:11pt">No. HP</span>
                </td>
                <td>
                    <span style="font-size:11pt"> : <?= $pecah['nohp'] ?></span>
                </td>
            </tr>
        </table>
        <br><br>
        <table cellspacing='0' cellpadding='0' style='width:660; font-size:12pt; font-family:calibri; border-collapse: collapse;' border='1'>
            <thead>
                <tr>
                    <th style="padding:5px;margin:5px">No</th>
                    <th width="50%">Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 1; ?>
                <?php $ambildetail = $koneksi->query("SELECT * FROM orderanproduk WHERE idorderan='$_GET[id]'"); ?>
                <?php while ($detail = $ambildetail->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $detail['nama']; ?></td>
                        <td align="left"> <?php echo harga($detail['harga']); ?></td>
                        <td align="center"><?php echo $detail['jumlah']; ?></td>
                        <td style="padding:5px;margin:5px"> <?php echo harga($detail['subharga']); ?></td>
                    </tr>
                    <?php $nomor++; ?>
                <?php } ?>
                <tr>
                    <td colspan="4" style="text-align:right">Total Harga : &nbsp;</b></em></td>
                    <td class="text-success" style="padding:5px;margin:5px"><?php echo harga($pecah['totalbeli']) ?></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right">Ongkir : &nbsp;</b></em></td>
                    <td class="text-success" style="padding:5px;margin:5px"><?php echo harga($pecah['ongkir']) ?></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right">Grand Total : &nbsp;</b></em></td>
                    <td class="text-success" style="padding:5px;margin:5px"><?php echo harga($pecah['totalbeli'] + $pecah['ongkir']) ?></td>
                </tr>
            </tbody>
        </table>
        <br><br>
        <table cellspacing='0' cellpadding='0' style='width:550px; font-size:11pt; font-family:calibri; border-collapse: collapse;'>
            <tr>
                <td width="60"><br><br><br><br></td>
                <?php
                $now = date("Y-m-d");

                ?>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;Penerima <br><br><br><br><br>(.....................)</td>
                <td width="130"><br><br><br><br></td>
                <?php
                $now = date("Y-m-d");

                ?>
                <td>Hormat Kami, <br><br><br><br><br>(.....................)</td>
            </tr>
        </table>
    </center>
</body>

</html>
<script>
    window.print();
</script>