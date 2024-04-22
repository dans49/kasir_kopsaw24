 <!--sidebar end-->

 <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
 <!--main content start-->
<?php 
	$id = $_SESSION['admin']['id_member'];
	$hasil = $lihat -> member_edit($id);
?>
<h4>Data Member</h4>
<br>
<?php if(isset($_GET['success'])){?>
<div class="alert alert-success">
	<p>Edit Data Berhasil !</p>
</div>
<?php }?>
<?php if(isset($_GET['remove'])){?>
<div class="alert alert-danger">
	<p>Hapus Data Berhasil !</p>
</div>
<?php }?>
<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#myModal">
  <i class="fa fa-plus"></i> Insert Data</button>
<a href="index.php?page=user" class="btn btn-success">
  <i class="fa fa-refresh"></i> Refresh Data</a>
<div class="clearfix"></div>
<br />

<div class="card card-body">
    <div class="table-responsive">
       <table class="table table-bordered table-striped table-sm" id="example1">
           <thead>
               <tr style="background:#DFF0D8;color:#333;">
                   <th>No.</th>
                   <th>Gambar</th>
                   <th>ID Member</th>
                   <th>Nama Member</th>
                   <th>Telepon</th>
                   <th>Email</th>
                   <th>Username</th>
                   <th>Aksi</th>
               </tr>
           </thead>
           <tbody>
               <?php 
				$no=1;
				foreach($lihat->member() as $isi) {
			?>
               <tr>
                   <td><?php echo $no;?></td>
                   <td><img src="assets/img/user/<?php echo $isi['gambar'];?>" width="60px"></td>
                   <td><?php echo $isi['id_member'];?></td>
                   <td><?php echo $isi['nm_member'];?></td>
                   <td><?php echo $isi['telepon'];?></td>
                   <td><?php echo $isi['email'];?></td>
                   <td> <?php echo $isi['user'];?></td>
                   <td>
                       <a href="index.php?page=user/details&barang=<?php echo $isi['id_barang'];?>"><button
                               class="btn btn-primary btn-sm">Details</button></a>

                       <a href="index.php?page=user/edit&barang=<?php echo $isi['id_barang'];?>"><button
                               class="btn btn-warning btn-sm">Edit</button></a>
                       <a href="fungsi/hapus/hapus.php?user=hapus&id=<?php echo $isi['id_barang'];?>"
                           onclick="javascript:return confirm('Hapus Data barang ?');"><button
                               class="btn btn-danger btn-sm">Hapus</button></a>
               </tr>
               <?php 
					$no++; 
				}
			?>
           </tbody>
       </table>
   </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style=" border-radius:0px;">
            <div class="modal-header" style="background:#285c64;color:#fff;">
                <h5 class="modal-title"><i class="fa fa-plus"></i> Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="fungsi/tambah/tambah.php?barang=tambah" method="POST">
                <div class="modal-body">
                    <table class="table table-striped bordered">
                        <?php
                            $format = $lihat -> barang_id();
                        ?>
                        <tr>
                            <td>ID Barang</td>
                            <td><input type="text" readonly="readonly" required value="<?php echo $format;?>"
                                    class="form-control" name="id"></td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td>
                                <select name="kategori" class="form-control" required>
                                    <option value="#">Pilih Kategori</option>
                                    <?php  $kat = $lihat -> kategori(); foreach($kat as $isi){  ?>
                                    <option value="<?php echo $isi['id_kategori'];?>">
                                        <?php echo $isi['nama_kategori'];?></option>
                                    <?php }?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Barang</td>
                            <td><input type="text" placeholder="Nama Barang" required class="form-control"
                                    name="nama"></td>
                        </tr>
                        <tr>
                            <td>Merk Barang</td>
                            <td><input type="text" placeholder="Merk Barang" required class="form-control"
                                    name="merk"></td>
                        </tr>
                        <tr>
                            <td>Harga Beli</td>
                            <td><input type="number" placeholder="Harga beli" required class="form-control"
                                    name="beli"></td>
                        </tr>
                        <tr>
                            <td>Harga Jual</td>
                            <td><input type="number" placeholder="Harga Jual" required class="form-control"
                                    name="jual"></td>
                        </tr>
                        <tr>
                            <td>Satuan Barang</td>
                            <td>
                                <select name="satuan" class="form-control" required>
                                    <option value="#">Pilih Satuan</option>
                                    <option value="PCS">PCS</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Stok</td>
                            <td><input type="number" required Placeholder="Stok" class="form-control"
                                    name="stok"></td>
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