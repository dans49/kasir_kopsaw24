<?php 
    @ob_start();
    session_start();
    if (!empty($_SESSION['admin'])) { } else {
        echo '<script>window.location="login.php";</script>';
        exit;
    }
    
    header("Content-Type: application/vnd.ms-excel charset=utf-8;");
    header("Content-Disposition: attachment; filename=laporan-nota" . date('Y-m-d') . ".xls");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private", false); 

    require 'config.php';
    require 'fungsi/Waktu.php';
    include 'fungsi/view/view.php';
    
    $lihat = new view($config);
    $frmwaktu = new Waktu;

    $bulan_tes = array(
        '01' => "Januari",
        '02' => "Februari",
        '03' => "Maret",
        '04' => "April",
        '05' => "Mei",
        '06' => "Juni",
        '07' => "Juli",
        '08' => "Agustus",
        '09' => "September",
        '10' => "Oktober",
        '11' => "November",
        '12' => "Desember"
    );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Nota</title>
</head>
<body>
    <div class="modal-view">
        <h3 style="text-align:center;">
            <?php if (!empty(htmlentities($_GET['cari']))) { ?>
                Data Laporan Transaksi <?= $bulan_tes[htmlentities($_GET['bln'])]; ?> <?= htmlentities($_GET['thn']); ?>
            <?php } elseif (!empty(htmlentities($_GET['hari']))) { ?>
                Data Laporan Transaksi <?= htmlentities($_GET['hari']); ?>
            <?php } else { ?>
                Data Laporan Transaksi <?= $bulan_tes[date('m')]; ?> <?= date('Y'); ?>
            <?php } ?>
        </h3>
        <table border="1" width="100%" cellpadding="3" cellspacing="4">
            <thead>
                <tr bgcolor="yellow">
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Nama Pelanggan</th>
                    <th style="width:10%;">Tanggal</th>
                    <th style="width:10%;">Pembayaran</th>
                    <th style="width:10%;">Kasir</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1; 
                    if (!empty(htmlentities($_GET['cari']))) {
                        $periode = htmlentities($_GET['thn']) . '-' . htmlentities($_GET['bln']);
                        $hasil = $lihat->periode_jual($periode);
                    } elseif (!empty(htmlentities($_GET['hari']))) {
                        $hari = htmlentities($_GET['hari']);
                        $hasil = $lihat->hari_jual($hari);
                    } else {
                        $hasil = $lihat->nota_penjualan();
                    }

                    foreach ($hasil as $isi) { 
                        $expl = explode(' ', $isi['waktudata']);
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $isi['id_nota']; ?></td>
                    <td><?php echo $isi['nm_pelanggan']; ?></td>
                    <td><?php echo $frmwaktu->tgl_indo($expl[0]); ?></td>
                    <td>Rp.<?php echo number_format($isi['bayar']); ?>,-</td>
                    <td><?php echo $isi['nm_member']; ?></td>
                    <td><?php echo $isi['status_nota']; ?></td>
                </tr>
                <?php $no++; } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
