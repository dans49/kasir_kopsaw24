<?php 
	@ob_start();
	session_start();
	if(!empty($_SESSION['admin'])){ }else{
		echo '<script>window.location="login.php";</script>';
        exit;
	}
	require 'config.php';
	include $view;
	$lihat = new view($config);
	$toko = $lihat -> toko();
	$hsl = $lihat -> penjualan_print($_GET['nota']);
?>
<html>
	<head>
		<title>Print Nota</title>
		<link rel="stylesheet" href="assets/css/bootstrap.css">
	</head>
	<body>
		<script>window.print();</script>
		<div class="container">
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-4">
					<center>
						<h2><?php echo $toko['nama_toko'];?></br>
						<?php echo $toko['alamat_toko'];?></h2>
						<p>Tanggal : <?php  echo date("j F Y, G:i");?></p>
					</center>
					<p>TRX : <?php  echo htmlentities($_GET['nota']);?> </br>
					Kasir : <?php  echo htmlentities($_SESSION['admin']['nm_member']);?></p>
					<table border="1" cellpadding="0" cellspacing="0" style="width:100%;">
						<tr>
							<th>No.</th>
							<th>Barang</th>
							<th>Harga Jual</th>
							<th>Diskon</th>
							<th>Jumlah</th>
							<th>Total</th>
						</tr>
						<?php $no=1; foreach($hsl as $isi){?>
						<tr align="center">
							<td><?php echo $no;?></td>
							<td><?php echo $isi['nama_barang'];?></td>
							<td><?php echo $isi['harga_jual'];?></td>
							<td><?php echo $isi['diskon'];?></td>
							<td><?php echo $isi['jumlah'];?></td>
							<td><?php echo $isi['total'];?></td>
						</tr>
						<?php $no++; }?>
					</table>
					<div class="pull-right">
						<?php $hasil = $lihat -> nota_print($_GET['nota']); ?>
						Total : Rp.<?php echo number_format($hasil['total']);?>,-
						<br/>
						Bayar : Rp.<?php echo number_format(htmlentities($hasil['bayar']));?>,-
						<br/>
						Kembali : Rp.<?php echo number_format(htmlentities($hasil['kembalian']));?>,-
					</div>
					<div class="clearfix"></div>
					<center>
						<p>Terima Kasih Telah berbelanja di toko kami !</p>
					</center>
				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>
	</body>
</html>
