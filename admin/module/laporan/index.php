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
			<?php if(!empty($_GET['cari'])){ 
				if($_GET['cari'] == 'ok'){ ?>
					Data Laporan Penjualan <?= $bulan_tes[$_GET['bln']];?> <?= $_GET['thn'];?>
				<?php
				} else { ?>
					Data Laporan Penjualan Tahun <?= $_GET['thn'];?>
				<?php
				}
			?>
			<?php }elseif(!empty($_GET['hari'])){?>
			Data Laporan Penjualan <?= $_GET['tgl'];?>
			<?php }else{?>
			Data Laporan Penjualan <?= $bulan_tes[date('m')];?> <?= date('Y');?>
			<?php }?>
		</h4>
		<br />
		<div class="card">
			<div class="card-header bg-warning">
				<b style="color: white;font-size: 15pt;">Cari Laporan Nota</b>
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
					<form method="post" action="index.php?page=laporan&cari=tahun">
						<table class="table table-striped">
							<tr>
								<th>
									Pilih Tahun
								</th>
								<th>
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
									<input type="hidden" name="kat_thn" value="tahun">
									<button class="btn btn-primary">
										<i class="fa fa-search"></i> Cari
									</button>
									<a href="index.php?page=laporan" class="btn btn-success">
										<i class="fa fa-refresh"></i> Refresh</a>

									<?php if(!empty($_GET['cari'])){?>
									<a href="excel.php?cari=tahun&thn=<?=$_GET['tahun'];?>"
										class="btn btn-info"><i class="fa fa-download"></i>
										Excel</a>
									<?php }else{?>
									<a href="excel.php" class="btn btn-info"><i class="fa fa-download"></i>
										Excel</a>
									<?php }?>
								</td>
							</tr>
						</table>
					</form>
					<?php
					if($_GET['cari'] == 'tahun' && $_POST['kat_thn'] == 'tahun') {
						$thn = $_POST['tahun'];
						echo "<script>document.location.href='index.php?page=laporan&cari=tahun&thn=$thn'</script>";
					}
					?>
				</div>

				<div id="caribulan">
					<form method="post" action="index.php?page=laporan&cari=ok">
						<table class="table table-striped">
							<tr>
								<th>
									Pilih Bulan
								</th>
								<th>
									Pilih Tahun
								</th>
								<th>
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
									for ($a=$now;$a>=2020;$a--)
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
									<a href="index.php?page=laporan" class="btn btn-success">
										<i class="fa fa-refresh"></i> Refresh</a>

									<?php if(!empty($_GET['cari'])){?>
									<a href="excel.php?cari=yes&bln=<?=$_GET['bln'];?>&thn=<?=$_GET['thn'];?>"
										class="btn btn-info"><i class="fa fa-download"></i>
										Excel</a>
									<?php }else{?>
									<a href="excel.php" class="btn btn-info"><i class="fa fa-download"></i>
										Excel</a>
									<?php }?>
								</td>
							</tr>
						</table>
					</form>
					<?php
					if(!empty($_POST['bln']) && !empty($_POST['thn'])) {
						$bln = $_POST['bln'];
						$thn = $_POST['thn'];
						echo "<script>document.location.href='index.php?page=laporan&cari=ok&bln=$bln&thn=$thn'</script>";
					}
					?>
				</div>

				<div id="carihari">
					<form method="post" action="index.php?page=laporan&hari=cek">
						<table class="table table-striped">
							<tr>
								<th>
									Pilih Hari
								</th>
								<th>
									Aksi
								</th>
							</tr>
							<tr>
								<td>
									<input type="date" value="<?= date('Y-m-d');?>" class="form-control" name="tgl">
								</td>
								<td>
									<input type="hidden" name="periode" value="ya">
									<button class="btn btn-primary">
										<i class="fa fa-search"></i> Cari
									</button>
									<a href="index.php?page=laporan" class="btn btn-success">
										<i class="fa fa-refresh"></i> Refresh</a>

									<?php if(!empty($_GET['hari'])){?>
									<a href="excel.php?hari=ok&tgl=<?= $_GET['tgl'];?>" class="btn btn-info"><i
											class="fa fa-download"></i>
										Excel</a>
									<?php }else{?>
									<a href="excel.php" class="btn btn-info"><i class="fa fa-download"></i>
										Excel</a>
									<?php }?>
								</td>
							</tr>
						</table>
					</form>
					<?php
					if($_GET['hari'] == 'cek') {
						$tgl = $_POST['tgl'];
						echo "<script>document.location.href='index.php?page=laporan&hari=ok&tgl=$tgl'</script>";
					}
					?>
				</div>
			</div>
		</div>
		<input type="text" name="filtercek" id="filtercek" value="<?=$_SESSION['lap_nota'] ?>" hidden>
         <br />
         <br />
         <!-- view Nota -->
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered w-100 table-sm" id="example1">
						<thead>
							<tr style="background:#DFF0D8;color:#333;">
								<th> No </th>
								<th> ID Transaksi</th>
								<th> Nama Pelanggan</th>
								<th style="width:10%;"> Tanggal</th>
								<th> Total Belanja</th>
								<th style="width:10%;"> Pembayaran</th>
								<th> Kasir</th>
								<th style="width:10%;"> Status</th>
								<th> Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$no=1; 
								if(!empty($_GET['cari'])){
									
									if($_GET['cari'] == 'ok') {
										$periode = $_GET['thn'].'-'.$_GET['bln'];
										$no=1; 
										$jumlah = 0;
										$bayar = 0;
										$hasil = $lihat -> periode_jual($periode);
									} else {
										$thn = $_GET['thn'];
										$no=1; 
										$jumlah = 0;
										$bayar = 0;
										$hasil = $lihat -> periode_jual($thn);
									}
								}elseif(!empty($_GET['hari'])){
									$hari = $_GET['tgl'];
									$no=1; 
									$jumlah = 0;
									$bayar = 0;
									$hasil = $lihat -> hari_jual($hari);
								}else{
									$hasil = $lihat -> nota_penjualan();
									
								}
							?>
							<?php 
								$bayar = 0;
								$jumlah = 0;
								$modal = 0;
								foreach($hasil as $isi){ 
									$expl = explode(' ', $isi['waktudata']);
									$notaid = $isi['id_nota'];
									$tanpatitik = str_replace(".","",$notaid); 
									
							?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $isi['id_nota'];?></td>
								<td><?php echo $isi['nm_pelanggan'];?></td> 
								<td><?php echo $frmwaktu->tgl_indo($expl[0]); ?></td>
								<td>Rp.<?php echo number_format($isi['total']);?>,-</td>
								<td>Rp.<?php echo number_format($isi['bayar']);?>,-</td>
								<td><?php echo $isi['nm_member'];?></td>
								<td>
									 <?php if($isi['status_nota']=="Lunas"){echo '<div class="btn btn-success btn-sm ">Lunas</div>';}
									 if($isi['status_nota']=="Hutang"){ echo '<div class="btn btn-danger btn-sm">Hutang</div>';}
									 ?>
								</td>
								<td><button type="button" class="btn btn-primary detailNota" data-toggle="modal" data-target="#rincianNota" value="1" data-load-code="<?php echo $isi['id_nota'];?>" data-id="<?php echo $isi['id_nota'];?>" data-status="<?=$isi['status_nota'] ?>">  Detail </button>
								<!-- <a href="fungsi/hapus/hapus.php?barang=hapus&id=<?php echo $isi['id_barang'];?>"
                                    onclick="javascript:return confirm('Hapus Data Transaksi ?');"><button
                                        class="btn btn-danger btn-sm">Hapus</button></a> -->
										<a href="fungsi/hapus/hapus.php?id_nota=<?= $nota['id_nota'];?>}" 
                           onclick='return confirm("Apakah Anda yakin ingin menghapus data ini?")' 
                           class='btn btn-danger btn-sm'>Hapus</a>
								</td>
								
							</tr>
							<?php $no++; }?>
						</tbody>
						
					</table>
				</div>
			</div>
		</div>
     </div>
 </div>


<!-- Modal untuk detail nota -->
<div id="rincianNota" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->

        <div class="modal-content" style=" border-radius:0px;">
            <div class="modal-header" style="background:#285c64;color:#fff;">
                <h5 class="modal-title"> Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
                <div class="modal-body">
                        <center>KPRI Sawangan</center>
                        <center>Bappelitbangda Kab. Tasikmalaya</center>
                        <center>Tanggal : <?php  echo date("j F Y, G:i"); ?></center>
                    <table width="100%" class="mt-2">
                        <tr>
                            <td>TRX</td>
                            <td>: <span id="trx"></span></td>
                        </tr>
                        <tr>
                            <td>Kasir </td>
                            <td>: <?php  echo htmlentities($_SESSION['admin']['nm_member']);?></td>
                        </tr>
                    </table>
                    <table class="table bordered mt-2">
                        <thead>
                            <tr>
                                <td>No.</td>
                                <td>Barang</td>
                                <td>Diskon</td>
                                <td>Jumlah</td>
                                <td>Total</td>
                            </tr>
                        </thead>
                        <tbody id="dataRincian">
						</tbody>
                    </table>
					<!-- modal status lunas -->
					
                    <div id="detailBayar"></div>
    
                </div>
                <div class="modal-footer">
                    <a href="#" id="printInv" target="_blank" class="btn btn-secondary btn-sm btnprint">
                        <i class="fa fa-print"></i> Print Invoice
                    </a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
        
        </div> 
		 <!-- Akhir Modal content-->
		<!-- akhir modal status lunas -->

    </div>

</div> 

<script>
	$(document).ready(function(){
		$('.detailNota').on('click', function(){
	        let idm = "<?php echo $_SESSION['admin']['id_member']; ?>"
	        let idn = $(this).data('id')
	        let status = $(this).data('status')
	        let filter = $('#filtercek').val()
	        var tgl = "<?= $_GET['tgl'] ?? '' ?>"
	        var bln = "<?=$_GET['bln'] ?? '' ?>"
	        var thn = "<?=$_GET['thn'] ?? '' ?>"
	        // $("#trx").html(idn)

	        $.ajax({
                type: 'POST',
                url: "fungsi/apis/apisrincinota.php",
                data: {
                	nota : idn,
                	memberid : idm,
                	status : status,
                	filter : filter,
                	tgl : tgl,
                	bln : bln,
                	thn : thn,
                },
                dataType: 'json',
                success: function(res) {
                	// console.log(res)
                    $("#trx").html(res.nota)
                    $("#gettotal").html(numberWithCommas(res.total))
                    $("#getbayar").html(numberWithCommas(res.bayar))
                    $("#getkembali").html(numberWithCommas(res.kembali))
                    $("#dataRincian").html(res.penjualan)
                    $("#detailBayar").html(res.getbayar)
                    $("#printInv").prop("href","print.php?nota="+res.nota)
                }
            })
	    });
	})

 	var sess = $("#filtercek").val()

 	if(sess == '') {
	 	$("#caribulan").hide();
	 	$("#carihari").hide();
	 	$("#caritahun").hide();
 	} else if(sess != ''){
 		if(sess == 'bulan'){
	 		$("#caribulan").show();
		 	$("#carihari").hide();
		 	$("#caritahun").hide();
	 	} else if(sess == 'tahun'){
	 		$("#caribulan").hide();
		 	$("#carihari").hide();
		 	$("#caritahun").show();
	 	} else if(sess == 'hari'){
	 		$("#caribulan").hide();
		 	$("#carihari").show();
		 	$("#caritahun").hide();
		 }
 	}

 	$(document).on('change','.filter', function(e) {
	    let cek = $(".filter").val();
	    // console.log(cek);

	    if (cek == 'hari') {
	    	$.ajax({
	    		url: "fungsi/apis/apisessionlap.php?status="+cek,
	    		method: 'GET',
	    		success: function(res) {
	    			$("#filtercek").val(res)
	    		}
	    	})
	    	$("#carihari").show();
	    	$("#caribulan").hide();
	    	$("#caritahun").hide();
	    	q = 'hari'
	    	
	    } else if (cek == 'bulan') {
	    	$.ajax({
	    		url: "fungsi/apis/apisessionlap.php?status="+cek,
	    		method: 'GET',
	    		success: function(res) {
	    			$("#filtercek").val(res)
	    		}
	    	})
	        $("#carihari").hide();
	    	$("#caribulan").show();
	    	$("#caritahun").hide();
	    	q = 'cek'
	    } else if (cek == 'tahun') {
	    	$.ajax({
	    		url: "fungsi/apis/apisessionlap.php?status="+cek,
	    		method: 'GET',
	    		success: function(res) {
	    			$("#filtercek").val(res)
	    		}
	    	})
	        $("#carihari").hide();
	    	$("#caribulan").hide();
	    	$("#caritahun").show();
	    } else {
	    	$.ajax({
	    		url: "fungsi/apis/apisessionlap.php?status=null",
	    		method: 'GET',
	    		success: function(res) {
	    			$("#filtercek").val(res)
	    		}
	    	})
	    }
	});
</script>