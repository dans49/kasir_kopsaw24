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
			<?php if(!empty($_GET['cari'])){ ?>
			Data Laporan Penjualan <?= $bulan_tes[$_POST['bln']];?> <?= $_POST['thn'];?>
			<?php }elseif(!empty($_GET['hari'])){?>
			Data Laporan Penjualan <?= $_POST['hari'];?>
			<?php }else{?>
			Data Laporan Penjualan <?= $bulan_tes[date('m')];?> <?= date('Y');?>
			<?php }?>
		</h4>
		<br />
		<div class="card">
			<div class="card-header">
				<h5 class="card-title mt-2">Cari Laporan Per Bulan</h5>
			</div>
			<div class="card-body p-0">
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
								<a href="excel.php?cari=yes&bln=<?=$_POST['bln'];?>&thn=<?=$_POST['thn'];?>"
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
								<input type="date" value="<?= date('Y-m-d');?>" class="form-control" name="hari">
							</td>
							<td>
								<input type="hidden" name="periode" value="ya">
								<button class="btn btn-primary">
									<i class="fa fa-search"></i> Cari
								</button>
								<a href="index.php?page=laporan" class="btn btn-success">
									<i class="fa fa-refresh"></i> Refresh</a>

								<?php if(!empty($_GET['hari'])){?>
								<a href="excel.php?hari=cek&tgl=<?= $_POST['hari'];?>" class="btn btn-info"><i
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
			</div>
		</div>
         <br />
         <br />
         <!-- view Nota -->
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered w-100 table-sm" id="example1">
						<thead>
							<tr style="background:#DFF0D8;color:#333;">
								<th> No</th>
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
									$periode = $_POST['thn'].'-'.$_POST['bln'];
									$no=1; 
									$jumlah = 0;
									$bayar = 0;
									$hasil = $lihat -> periode_jual($periode);
								}elseif(!empty($_GET['hari'])){
									$hari = $_POST['hari'];
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
								<td><button type="button" class="btn btn-primary" id="detail" data-toggle="modal" data-target="#detailRincian<?php echo $tanpatitik;?>" value="1" data-load-code="<?php echo $isi['id_nota'];?>">  Detail </button>
 <!-- Modal untuk detail nota -->
<div id="detailRincian<?php echo $tanpatitik;?>" class="modal fade" role="dialog">
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
                            <center>Tanggal : <?php echo $frmwaktu->tgl_indo($expl[0]); ?></center>
                        <table width="100%" class="mt-2">
                            <tr>
                                <td>TRX</td>
                                <td>: <span id=""><?php echo $isi['id_nota'];?></span></td>
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
                                    <td>Jumlah</td>
                                    <td>Total</td>
                                </tr>
                            </thead>
                            <tbody id="">

							
							<?php			 
							$nomor=0;
							$total2=0;
							$host 	= 'localhost'; // host server
							$user 	= 'root';  // username server
							$pass 	= ''; // password server, kalau pakai xampp kosongin saja
							$dbname = 'db_niagakopsaw'; // nama database anda

							$koneksi = mysqli_connect($host, $user, $pass, $dbname);
							$id = $isi['id_nota'];
							$sql = "SELECT * from rincian 
							join nota on nota.id_nota=rincian.id_nota 
							join barang on barang.id_barang=rincian.id_barang						
							where rincian.id_nota = '$id' ";
							$conn = mysqli_query($koneksi,$sql);
							while($isi2=mysqli_fetch_array($conn)) { 
								$nomor++;
								$jumlahpcs = $isi2['total_pembelian'] / $isi2['harga_jual'];
								$total2 +=  $isi2['total_pembelian'];
								$total3 +=  $isi2['total_pembelian'];
								$sisa = $total2-$isi2['bayar'];
								$bayar2 = $isi2['bayar'];
								$id_nota = $isi2['nota.id_nota'];
								
								?>
							<tr>
								<td><?php echo $nomor;?></td>
								<td><?php echo $isi2['nama_barang'];?></td>
								<td><?php echo $jumlahpcs?></td>
								<td><?php echo $isi2['total_pembelian'];?></td>
							</tr> <?php } ?>

							</tbody>
                        </table>
						<!-- modal status lunas -->
			<?php if($isi['status_nota']=="Lunas"){ ?>
                        <div class="pull-right">
                           
                            Total : Rp. <?php echo $total2;?> ,-
                            <br/>
                            Bayar : Rp. <?php echo $bayar2?>,-
                            <br/>
                            Kembali : Rp. <?php if($bayar2==0){echo "0";} else{ echo $bayar2-$total2;}?>,-
                        </div>

						<?php } else {?>    
							<form method="POST" id="bayar_hutang" action="fungsi/edit/edit.php?nota=edit" > 
                            
                        <div class="row">                            
                            <div class="col-sm-2.5 ">Total :</div>
                            <div class="col-sm-4">Rp. <?php echo $total2;?> ,-</div>
                        </div>
                        
                        <div class="row">                            
                            <div class="col-sm-2.5 ">Bayar :</div>
                            <div class="col-sm-4"><input type="number" id="bayar" class="form-control" name="bayar" value='<?php echo $sisa ?>' required></div>

							<input type="text" name="total_blj" value= "<?=$total2 ?>" hidden>
							<input type="text" name="status_nota" value= "Lunas" hidden >
							<input type="text" name="id_nota" value= "<?php echo $isi['id_nota'];?>" hidden >
							<div class="col-sm-3">
                                <button type="submit" class="btn btn-success btn-sm-2"><i class="fa fa-shopping-cart "></i> Bayar </button>                              
                            </div>                           
                        </div>
                       </form>    <?php }?>                  
                    </div>
                    <div class="modal-footer">
                        <!-- <a href="" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print</a> -->
                        <a href="#" id="printinv" target="_blank" class="btn btn-secondary btn-sm btnprint">
                                <i class="fa fa-print"></i> Print Invoice
                        </a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
            
            </div> 
			 <!-- Akhir Modal content-->
			<!-- akhir modal status lunas -->
			
				


        </div>

    </div> 
	<!-- Akhir Modal untuk detail nota -->
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


