<h4>pelanggan dong</h4>
<br />
<?php if(isset($_GET['success-pelanggan'])){?>
<div class="alert alert-success">
    <p>Tambah Pelanggan Berhasil !</p>
</div>
<?php }?>
<?php if(isset($_GET['success-edit'])){?>
<div class="alert alert-success">
    <p>Update Pelanggan Berhasil !</p>
</div>
<?php }?>
<?php if(isset($_GET['remove'])){?>
<div class="alert alert-danger">
    <p>Hapus Pelanggan Berhasil !</p>
</div>
<?php }?>

<?php 
    $sql=" select * from ksw_pelanggan ";
    $row = $config -> prepare($sql);
    $row -> execute();
    $r = $row -> rowCount();
    
?>
<button type="button" class="btn btn-primary btn-md mr-2" data-toggle="modal" data-target="#myModalPelanggan">
    <i class="fa fa-plus"></i> Insert Data</button>

<div class="clearfix"></div>
<br />

<!-- view pelanggan -->
<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm" id="example1">
            <thead>
                <tr style="background:#DFF0D8;color:#333;">
                    <th>No.</th>
                    <th>Nama Pelanggan</th>
                    <th>Identitas</th>
                    <th>No. HP</th> 
                    <th>Status</th> 
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
				$hasil = $lihat -> pelanggan();
				$no=1;
				foreach($hasil as $isi){
			?>
                <tr>
                    <td><?php echo $no;?></td>
                    <td><?php echo $isi['nm_pelanggan'];?></td>
                    <td><?php echo $isi[''];?></td>
                    <td><?php echo $isi['telepon'];?></td>
                    <td><?php echo $isi['statusdata'];?></td>
                    
                    <td>

                    <a href="fungsi/hapus/hapus.php?pelanggan=hapus&id=<?php echo $isi['id_pelanggan'];?>"
                            onclick="javascript:return confirm('Hapus Data Pelanggan ?');"><button
                                class="btn btn-danger">Hapus</button></a>

                        <!-- <a href="index.php?page=pelanggan&uid=<?php echo $isi['id_pelanggan'];?>"><button
                                class="btn btn-warning">Edit</button></a>
                        <a href="fungsi/hapus/hapus.php?pelanggan=hapus&id=<?php echo $isi['id_pelanggan'];?>"
                            onclick="javascript:return confirm('Hapus Data Kategori ?');"><button
                                class="btn btn-danger">Hapus</button></a> -->
                    </td>
                </tr>
                <?php $no++; }?>
            </tbody>
            </table>
    </div>
</div>

<!-- tambah barang MODALS-->
<!-- Modal -->

<div id="myModalPelanggan" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style=" border-radius:0px;">
            <div class="modal-header" style="background:#285c64;color:#fff;">
                <h5 class="modal-title"><i class="fa fa-plus"></i> Tambah Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="fungsi/tambah/tambah.php?pelanggan=tambah" method="POST">
                <div class="modal-body">
                    <table class="table table-striped bordered">
                        <?php
                            $format = $lihat -> pelanggan();
                        ?>
                        
                       
                        <tr>
                            <td>Nama Pelanggan</td>
                            <td><input type="text" placeholder="Nama Pelanggan" required class="form-control"
                                    name="nama"></td>
                        </tr>
                        <tr>
                            <td>Identitas</td>
                            <td><input type="text" placeholder="Identitas Pelanggan" required class="form-control"
                                    name="identitas"></td>
                        </tr>
                        <tr>
                            <td>Tanggal Input</td>
                            <td><input type="text" required readonly="readonly" class="form-control"
                                    value="<?php echo  date("j F Y, G:i");?>" name="tgl"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Insert
                        Data</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>

</div>