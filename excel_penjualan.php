<?php 
	@ob_start();
	session_start();
	if(!empty($_SESSION['admin'])){ }else{
		echo '<script>window.location="login.php";</script>';
        exit;
	}
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=laporan-barang-terjual_".date('Y-m-d').".xls");  //File name extension was wrong
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
                <?php if(!empty(htmlentities($_GET['cari']))){  
                    if($_GET['cari'] == 'yes') {
                    ?>
                        Data Laporan Penjualan Barang Bulan <?= $bulan_tes[htmlentities($_GET['bln'])];?> Tahun <?= htmlentities($_GET['thn']);?>
                    <?php
                    } else { ?>
                        Data Laporan Penjualan Barang Tahun <?= htmlentities($_GET['thn']);?>
                    <?php 
                    }

                }elseif(!empty(htmlentities($_GET['hari']))){?>
                    Data Laporan Penjualan Barang Tanggal <?= $waktu->tgl_indo(htmlentities($_GET['tgl']));?>
                <?php }else{?>
                    Data Laporan Penjualan Barang <?= $bulan_tes[date('m')];?> <?= date('Y');?>
                <?php }?>
        </h3>
        <table border="1" width="100%" cellpadding="3" cellspacing="4">
            <thead>
                <tr bgcolor="yellow">
                    <th> No</th>
                    <th> Nama Barang</th>
                    <th style="width:10%;"> Jumlah Terjual</th>
                    <th style="width:10%;"> Modal</th>
                    <th style="width:10%;"> Cash</th>
                    <th style="width:10%;"> Credit</th>
                    <th style="width:10%;"> Total Terjual</th>
                    <th style="width:10%;"> Kasir</th>
                    
                    <!-- <th> Tanggal Transaksi</th> -->
                </tr>
            </thead>
            <tbody>
                <?php 
                    $no=1; 
                    if(!empty(htmlentities($_GET['cari']))){
                        
                        if($_GET['cari'] == 'yes') {

                            $periode = htmlentities($_GET['thn']).'-'.htmlentities($_GET['bln']);
                            $no=1; 
                            $jumlah = 0;
                            $bayar = 0;
                            $hasil = $lihat -> periode_penjual($periode);
                        } else {
                            $thn = htmlentities($_GET['thn']);
                            $no=1; 
                            $jumlah = 0;
                            $bayar = 0;
                            $hasil = $lihat -> tahun_barang_jual($thn);

                        }
                    }elseif(!empty(htmlentities($_GET['hari']))){
                        $hari = htmlentities($_GET['tgl']);
                        $no=1; 
                        $jumlah = 0;
                        $bayar = 0;
                        $hasil = $lihat -> hari_barang_jual($hari);
                    }else{
                        $hasil = $lihat -> barang_jual();
                    }
                ?>
                <?php 
                    $bayar = 0;
                    $jumlah = 0;
                    $modal = 0;
                    $jcash = 0;
                    $jcredit = 0;
                    foreach($hasil as $isi){ 
                        $bayar += $isi['totalb'];
                        $modal += $isi['harga_satuan_beli']* $isi['terjual'];
                        $jumlah += $isi['terjual'];
                        $expl = explode(' ', $isi['waktudata']);

                        if(!empty($_GET['cari'])){
                            if($_GET['cari'] == 'yes') {
                                $periode = $_POST['thn'].'-'.$_POST['bln'];
                                $hsl_penj = $lihat -> sumcashcari($isi['id_barang'],$periode);
                                $hsl_cr = $lihat->sumcreditcari($isi['id_barang'],$periode);
                            } else {
                                $thn = $_POST['tahun'];
                                $hsl_penj = $lihat -> sumcashcari($isi['id_barang'],$thn);
                                $hsl_cr = $lihat->sumcreditcari($isi['id_barang'],$thn);

                            }
                        }elseif(!empty($_GET['hari'])){
                            $hari = $_POST['hari'];
                            $hsl_penj = $lihat -> sumcashcari($isi['id_barang'],$hari);
                            $hsl_cr = $lihat->sumcreditcari($isi['id_barang'],$hari);
                        }else{
                            $hsl_penj = $lihat->sumcash($isi['id_barang'],date('m'),date('Y'));
                            $hsl_cr = $lihat->sumcredit($isi['id_barang'],date('m'),date('Y'));
                        }

                        $jcash += $hsl_penj['totc'];
                        $jcredit += $hsl_cr['totcr'];
                ?> 
                <tr>
                    <td><?php echo $no;?></td>
                    
                    <td><?php echo $isi['nama_barang'];?></td>
                    <td><?php echo $isi['terjual'];?> </td>
                    <td><?php echo ($isi['harga_satuan_beli']-$isi['diskon'])* $isi['terjual']; ?></td>
                    <td align="right"><?= $hsl_penj['totc'] ?? '0'; ?></td>
                    <td align="right"><?= $hsl_cr['totcr'] ?? '0'; ?></td>
                    <td><?php echo $isi['totalb'];?></td>
                    <td><?php echo $isi['nm_member'];?></td>
                    
                    <!-- <td><?php echo $waktu->tgl_indo($expl[0]); ?></td> -->
                </tr>
                <?php $no++; }?>
                <tr bgcolor="mediumseagreen">
                    <td colspan ="2"><b>Total Terjual</b></td>
                    <td><b><?php echo $jumlah;?></b></td>
                    <td><b><?php echo $modal;?></b></td>
                    <td><b><?php echo $jcash;?></b></td>
                    <td><b><?php echo $jcredit;?></b></td>
                    <td><b><?php echo $bayar;?></b></td>
                    
                    <td ><b> Keuntungan : <?php echo $bayar-$modal;?></b></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
