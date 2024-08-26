 <?php 
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
<div class="row">
	<div class="col-md-12">
		<h4>
			<!--<a  style="padding-left:2pc;" href="fungsi/hapus/hapus.php?laporan=jual" onclick="javascript:return confirm('Data Laporan akan di Hapus ?');">
						<button class="btn btn-danger">RESET</button>
					</a>-->
			<?php 
			if(!empty($_GET['cari'])){ 
				if($_GET['cari'] == 'ok'){ ?>
					Data Laporan Penjualan <?= $bulan_tes[$_POST['bln']];?> <?= $_POST['thn'];?>
				<?php
				} else { ?>
					Data Laporan Penjualan Tahun <?= $_POST['tahun'];?>
				<?php
				}
			?>
			<?php }elseif(!empty($_GET['hari'])){?>
			Data Laporan Penjualan <?= $_POST['hari'];?>
			<?php }else{?>
			Data Laporan Penjualan <?= $bulan_tes[date('m')];?> <?= date('Y');?>
			<?php }?>
		</h4>
		<br />
		<div class="card">
			<div class="card-header bg-info">
				<!-- <h5 class="card-title mt-2">Cari Laporan</h5> -->
				<b style="color: white; font-size: 15pt;">Cari Laporan</b>
			</div>
			<div class="card-body p-0">
				<div class="container-fluid">
					<div class="form-group mt-2 row">
					    <label for="staticEmail" class="col-sm-1 col-form-label">Filter</label>
					    <div class="col-sm-3">
					      	<select class="form-control filter" name="filter">
					      		<option value="">&mdash; Pilih Filter Laporan &mdash;</option>
					      		<option value="hari">Laporan Harian</option>
					      		<option value="bulan">Laporan Bulanan</option>
					      		<option value="tahun">Laporan Tahunan</option>
					      	</select>
					    </div>
				  	</div>
				</div>

				<div id="caritahun">
					<form method="post" action="index.php?page=laporan_penjualan&cari=tahun">
						<table class="table table-striped">
							<tr>
								<th bgcolor="#C2E7FF">
									Pilih Tahun
								</th>
								<th bgcolor="#C2E7FF">
									Aksi
								</th>
							</tr>
							<tr>
								<td>
								<?php
									$now=date('Y');
									echo "<select name='tahun' class='form-control'>";
									echo '
									<option selected="selected">Tahun</option>';
									for ($a=$now;$a>=2019;$a--)
									{
										echo "<option value='$a'>$a</option>";
									}
									echo "</select>";
								?>
								</td>
								<td>
									<input type="hidden" name="periode" value="ya">
									<button class="btn btn-primary">
										<i class="fa fa-search"></i> Cari
									</button>
									<a href="index.php?page=laporan_penjualan" class="btn btn-success">
										<i class="fa fa-refresh"></i> Refresh</a>

									<?php if(!empty($_GET['cari'])){?>
									<a href="excel_penjualan.php?cari=tahun&thn=<?=$_POST['tahun'];?>"
										class="btn btn-info"><i class="fa fa-download"></i>
										Excel</a>
									<?php }else{?>
									<a href="excel_penjualan.php" class="btn btn-info"><i class="fa fa-download"></i>
										Excel</a>
									<?php }?>
								</td>
							</tr>
						</table>
					</form>
				</div>

				<div id="caribulan">
					<form method="post" action="index.php?page=laporan_penjualan&cari=ok">
						<table class="table table-striped">
							<tr>
								<th bgcolor="#C2E7FF">
									Pilih Bulan
								</th>
								<th bgcolor="#C2E7FF">
									Pilih Tahun
								</th>
								<th bgcolor="#C2E7FF">
									Aksi
								</th>
							</tr>
							<tr>
								<td>
									<select name="bln" class="form-control">
										<option selected="selected">Bulan</option>
										<?php
									$bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
									$jlh_bln=count($bulan);
									$bln1 = array('01','02','03','04','05','06','07','08','09','10','11','12');
									$no=1;
									for($c=0; $c<$jlh_bln; $c+=1){
										echo"<option value='$bln1[$c]'> $bulan[$c] </option>";
									$no++;}
								?>
									</select>
								</td>
								<td>
								<?php
									$now=date('Y');
									echo "<select name='thn' class='form-control'>";
									echo '
									<option selected="selected">Tahun</option>';
									for ($a=$now;$a>=2019;$a--)
									{
										echo "<option value='$a'>$a</option>";
									}
									echo "</select>";
								?>
								</td>
								<td>
									<input type="hidden" name="periode" value="ya">
									<button class="btn btn-primary">
										<i class="fa fa-search"></i> Cari
									</button>
									<a href="index.php?page=laporan_penjualan" class="btn btn-success">
										<i class="fa fa-refresh"></i> Refresh</a>

									<?php if(!empty($_GET['cari'])){?>
									<a href="excel_penjualan.php?cari=yes&bln=<?=$_POST['bln'];?>&thn=<?=$_POST['thn'];?>"
										class="btn btn-info"><i class="fa fa-download"></i>
										Excel</a>
									<?php }else{?>
									<a href="excel_penjualan.php" class="btn btn-info"><i class="fa fa-download"></i>
										Excel</a>
									<?php }?>
								</td>
							</tr>
						</table>
					</form>
				</div>

				<div id="carihari">
					<form method="post" action="index.php?page=laporan_penjualan&hari=cek">
						<table class="table table-striped">
							<tr>
								<th bgcolor="#C2E7FF">
									Pilih Hari
								</th>
								<th bgcolor="#C2E7FF">
									Aksi
								</th>
							</tr>
							<tr>
								<td>
									<input type="date" value="<?= date('Y-m-d');?>" class="form-control" name="hari">
								</td>
								<td>
									<input type="hidden" name="periode" value="ya">
									<button class="btn btn-primary">
										<i class="fa fa-search"></i> Cari
									</button>
									<a href="index.php?page=laporan_penjualan" class="btn btn-success">
										<i class="fa fa-refresh"></i> Refresh Hari</a>

									<?php if(!empty($_GET['hari'])){?>
									<a href="excel_penjualan.php?hari=cek&tgl=<?= $_POST['hari'];?>" class="btn btn-info"><i
											class="fa fa-download"></i>
										Excel</a>
									<?php }else{?>
									<a href="excel_penjualan.php" class="btn btn-info"><i class="fa fa-download"></i>
										Excel</a>
									<?php }?>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
         <br />
         <br />
         <!-- view barang -->
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered w-100 table-sm" id="example1">
						<thead>
							<tr style="background:#DFF0D8;color:#333;">
								<th width="7%"> No</th>
								<th width="10%"> ID Barang</th>
								<th> Nama Barang</th>
								<th width="12%"> Jumlah Terjual</th>
								<th style="width:10%;"> Modal</th>
								<th style="width:10%;"> Cash</th>
								<th style="width:10%;"> Credit</th>
								<th style="width:10%;"> Total Terjual</th>
								<th width="20%"> Kasir</th>
								<!-- <th> Tanggal Input</th> -->
							</tr>
						</thead>
						<tbody>
						 	<?php 
								$no=1; 
								if(!empty($_GET['cari'])){
									if($_GET['cari'] == 'ok') {

										$periode = $_POST['thn'].'-'.$_POST['bln'];
										$no=1; 
										$jumlah = 0;
										$bayar = 0;
										$hasil = $lihat -> periode_penjual($periode);
									} else {
										$thn = $_POST['tahun'];
										$no=1; 
										$jumlah = 0;
										$bayar = 0;
										$hasil = $lihat -> tahun_barang_jual($thn);

									}
								}elseif(!empty($_GET['hari'])){
									$hari = $_POST['hari'];
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
									$modal += ($isi['harga_satuan_beli']-$isi['diskon'])* $isi['terjual'];
									$jumlah += $isi['terjual'];
									$expl = explode(' ', $isi['waktudata']);

									if(!empty($_GET['cari'])){
										if($_GET['cari'] == 'ok') {
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
								<td><?php echo $isi['id_barang'];?></td>
								<td><?php echo $isi['nama_barang'];?></td>
								<td align="center"><?php echo $isi['terjual'];?> </td>
								<td align="right">Rp. <?php echo number_format(($isi['harga_satuan_beli']-$isi['diskon'])* $isi['terjual']);?>,-</td>
								<td align="right">Rp <?=number_format($hsl_penj['totc'] ?? '0'); ?>,-</td>
								<td align="right">Rp <?=number_format($hsl_cr['totcr'] ?? '0'); ?>,-</td>
								<td align="right">Rp. <?php echo number_format($isi['totalb']);?>,-</td>
								<td><?php echo $isi['nm_member'];?></td>
								<!-- <td><?php echo $frmwaktu->tgl_indo($expl[0]); ?></td> -->
							</tr>
							<?php $no++; }?>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="3">Total Terjual</th>
								<td align="center"><b><?php echo $jumlah;?></b></td>
								<td align="right" style="font-weight: bold">Rp. <?php echo number_format($modal);?>,-</td>
								<td align="right" style="font-weight: bold">Rp. <?php echo number_format($jcash);?>,-</td>
								<td align="right" style="font-weight: bold">Rp. <?php echo number_format($jcredit);?>,-</td>
								<td align="right" style="font-weight: bold">Rp. <?php echo number_format($bayar);?>,-</td>
								<th style="background:#0bb365;color:#fff;">Keuntungan : Rp. <?php echo number_format($bayar-$modal);?>,-</th>
								<!-- <th style="background:#0bb365;color:#fff;"></th> -->
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
     </div>
 </div>

 <script>
 	url_string = window.location.href 
 	var url = new URL(url_string);
 	var h = url.searchParams.get("hari");
 	var c = url.searchParams.get("cari");
 	// console.log(c);

 	if(c == null && h == null) {
	 	$("#caribulan").hide();
	 	$("#carihari").hide();
	 	$("#caritahun").hide();
 	} else if(c == 'ok' && h == null){
 		$("#caribulan").show();
	 	$("#carihari").hide();
	 	$("#caritahun").hide();
 	} else if(c == 'tahun' && h == null){
 		$("#caribulan").hide();
	 	$("#carihari").hide();
	 	$("#caritahun").show();
 	} else if(c == null && h == 'cek'){
 		$("#caribulan").hide();
	 	$("#carihari").show();
	 	$("#caritahun").hide();
 	}

 	$(document).on('change','.filter', function(e) {
	    let cek = $(".filter").val();
	    // console.log(cek);

	    if (cek == 'hari') {
	    	$("#carihari").show();
	    	$("#caribulan").hide();
	    	$("#caritahun").hide();
	    	q = 'hari'
	    	
	    } else if (cek == 'bulan') {
	        $("#carihari").hide();
	    	$("#caribulan").show();
	    	$("#caritahun").hide();
	    	q = 'cek'
	    } else if (cek == 'tahun') {
	        $("#carihari").hide();
	    	$("#caribulan").hide();
	    	$("#caritahun").show();
	    }
	});
 </script>