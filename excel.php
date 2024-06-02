<?php 
	@ob_start();
	session_start();
	if(!empty($_SESSION['admin'])){ }else{
		echo '<script>window.location="login.php";</script>';
        exit;
	}
    header("Content-Type:   application/vnd.ms-excel charset=utf-8;" );
    header("Content-Disposition: attachment; filename=laporan-nota".date('Y-m-d').".xls");  //File name extension was wrong
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); 

    require 'config.php';
    require 'fungsi/Waktu.php';
    include $view;
    $lihat = new view($config);
    $waktu = new Waktu;

    $bulan_tes =array(
        '01'=>"Januari",
        '02'=>"Februari",
        '03'=>"Maret",
        '04'=>"April",
        '05'=>"Mei",
        '06'=>"Juni",
        '07'=>"Juli",
        '08'=>"Agustus",
        '09'=>"September",
        '10'=>"Oktober",
        '11'=>"November",
        '12'=>"Desember"
    );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
	<!-- view barang -->	
    <!-- view barang -->	
    <div class="modal-view">
        <h3 style="text-align:center;"> 
                <?php if(!empty(htmlentities($_GET['cari']))){ ?>
                    Data Laporan Transaksi <?= $bulan_tes[htmlentities($_GET['bln'])];?> <?= htmlentities($_GET['thn']);?>
                <?php }elseif(!empty(htmlentities($_GET['hari']))){?>
                    Data Laporan Transaksi <?= htmlentities($_GET['tgl']);?>
                <?php }else{?>
                    Data Laporan Transaksi <?= $bulan_tes[date('m')];?> <?= date('Y');?>
                <?php }?>
        </h3>
        <table border="1" width="100%" cellpadding="3" cellspacing="4">
            <thead>
            <tr style="background:#DFF0D8;color:#333;">
			    <th> No</th>
			    <th> Nama Pelanggan</th>
			    <th style="width:10%;"> Tanggal</th>
			    <th style="width:10%;"> Pembayaran</th>
			    <th style="width:10%;"> Status</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                    $no=1; 
                    if(!empty(htmlentities($_GET['cari']))){
                        $periode = htmlentities($_GET['bln']).'-'.htmlentities($_GET['thn']);
                        $no=1; 
                        $jumlah = 0;
                        $bayar = 0;
                        $hasil = $lihat -> periode_penjual($periode);
                    }elseif(!empty(htmlentities($_GET['hari']))){
                        $hari = htmlentities($_GET['tgl']);
                        $no=1; 
                        $jumlah = 0;
                        $bayar = 0;
                        $hasil = $lihat -> hari_barang_jual($hari);
                    }else{
                        $hasil = $lihat -> nota_penjualan();
                    }
                ?>
                <?php 
                    $bayar = 0;
                    $jumlah = 0;
                    $modal = 0;
                    foreach($hasil as $isi){ 
                        $bayar += $isi['total'];
                        $modal += $isi['harga_beli'] * $isi['jumlah'];
                        $jumlah += $isi['jumlah'];
                        $expl = explode(' ', $isi['waktudata']);
                ?> 
                <tr>
                    <td><?php echo $no;?></td>
                    
                    <td><?php echo $isi['nama_barang'];?></td>
                    <td><?php echo $isi['jumlah'];?> </td>
                    <td>Rp.<?php echo number_format($isi['harga_beli']* $isi['jumlah']);?>,-</td>
                    <td>Rp.<?php echo number_format($isi['total']);?>,-</td>
                    
                    <td><?php echo $waktu->tgl_indo($expl[0]); ?></td>
                </tr>
                <?php $no++; }?>
                <tr bgcolor="mediumseagreen">
                    <td colspan ="2"><b>Total Terjual</b></td>
                    <td><b><?php echo $jumlah;?></b></td>
                    <td><b>Rp.<?php echo number_format($modal);?>,-</b></td>
                    <td><b>Rp.<?php echo number_format($bayar);?>,-</b></td>
                    
                    <td ><b> Keuntungan : Rp.<?php echo number_format($bayar-$modal);?>,-</b></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
