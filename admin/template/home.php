<h3>Dashboard</h3>
<br/>
<?php 
	$sql=" select * from barang where stok <= 3";
	$row = $config -> prepare($sql);
	$row -> execute();
	$r = $row -> rowCount();
	if($r > 0){
?>
<?php
		echo "
		<div class='alert alert-warning'>
			<span class='glyphicon glyphicon-info-sign'></span> Ada <span style='color:red'>$r</span> barang yang Stok tersisa sudah kurang dari 3 items. silahkan pesan lagi !!
			<span class='pull-right'><a href='index.php?page=barang&stok=yes'>Tabel Barang <i class='fa fa-angle-double-right'></i></a></span>
		</div>
		";	
	}
?>
<?php $hasil_barang = $lihat -> barang_row();?>
<?php $hasil_kategori = $lihat -> kategori_row();?>
<?php $stok = $lihat -> barang_stok_row();?>
<?php $jual = $lihat -> jual_row();?>
<div class="row">
    <!--STATUS cardS -->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-cubes"></i> Data Barang</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($hasil_barang);?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=barang'>Tabel
                    Barang <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
    <!-- STATUS cardS -->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-warning text-white">
                <h6 class="pt-2"><i class="fas fa-chart-bar"></i> Stok Barang</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($stok['jml']);?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=barang'>Tabel
                    Barang <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
    <!-- STATUS cardS -->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-list"></i> Kategori </h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($hasil_kategori);?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=laporan'>Tabel
                    Kategori <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h6 class="pt-2"><i class="fas fa-upload"></i> Telah Terjual</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($jual['stok']);?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=laporan'>Tabel
                    Barang Terjual <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
</div>

<!-- <div class="row">
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h6 class="pt-2"><i class="fa fa-bookmark"></i> Laporan Penjualan</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($hasil_kategori);?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=kategori'>Tabel
                    Kategori <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        
    </div>

    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h6 class="pt-2"><i class="fa fa-bookmark"></i> Laporan Pembelian</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($hasil_kategori);?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=kategori'>Tabel
                    Kategori <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        
    </div>
</div> -->

<div class="row">
    <div class="col-md-12 mb-3" id="grafikPenjualan">
        <div class="card">
            <div class="card-header bg-success text-white">
                Grafik Penjualan
            </div>
            <div class="card-body">
                <div class="row">
                    
                    <div class="col-md-2">
                        <input type="hidden" name="getnow" id="yearnow" value="<?=date('Y') ?>">
                        <select class="form-control" id="chartyear">
                                
                            <?php
                            for ($i=date('Y'); $i > 2019; $i--) { 
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <a href="index.php" class="btn btn-success"><i class="fa fa-sync"></i></a>
                    </div>
                </div>
                <div class="chart">
                    <canvas id="penjualan-chart" style="min-height: 250px; height: 450px; max-height: 550px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
</div>