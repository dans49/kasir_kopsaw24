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
                   
                   <td><?php echo $isi['nm_member'];?></td>
                   <td><?php echo $isi['telepon'];?></td>
                   <td><?php echo $isi['email'];?></td>
                   <td> <?php echo $isi['user'];?></td>
                   <td>
                   <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModaldetail<?php echo $isi['id_member'];?>">
                   Details Data</button>
<!-- awal modal detail -->
<div id="myModaldetail<?php echo $isi['id_member'];?>" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal detail user content-->
        <div class="modal-content" style=" border-radius:0px;">
            <div class="modal-header" style="background:#285c64;color:#fff;">
                <h5 class="modal-title"><i class=""></i> Details Member</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
         
                <div class="modal-body">
                    <table class="table table-striped bordered">
                            <input type="text"  readonly="readonly" required value="<?php echo $isi['id_member'];?>" class="form-control" name="id_member" hidden>                        
                        <tr>
                            <td>Username</td>
                            <td><?php echo $isi['nm_member'];?></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><?php echo $isi['pass'];?></td>
                        </tr>                        
                            <td>Telepon</td>
                            <td><?php echo $isi['telepon'];?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $isi['email'];?></td>
                        </tr>

                    </table>
                </div>
                <div class="modal-footer">
                   
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>
<!-- akhir modal detail -->
                       
                       <a href="fungsi/hapus/hapus.php?user=hapus&id=<?php echo $isi['id_member'];?>"
                           onclick="javascript:return confirm('Hapus Data?');"><button
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
        <!-- Modal tambah user content-->
        <div class="modal-content" style=" border-radius:0px;">
            <div class="modal-header" style="background:#285c64;color:#fff;">
                <h5 class="modal-title"><i class="fa fa-plus"></i> Tambah Member</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="fungsi/tambah/tambah.php?user=tambah" method="POST">
                <div class="modal-body">
                    <table class="table table-striped bordered">
                    <?php $format = $lihat -> member_id();
						?>                    
                            <input type="text" hidden readonly="readonly" required value="<?php echo $format;?>" class="form-control" name="id_member">
                            <input type="text" hidden readonly="readonly" required value="unnamed.jpg" class="form-control" name="gambar">
                        <tr>
                            <td>Username</td>
                            <td><input type="text" placeholder="Username" required class="form-control"
                                    name="username"></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="text" placeholder="Password" required class="form-control"
                                    name="password"></td>
                        <tr>
                            <td>Telepon</td>
                            <td><input type="text" placeholder="Telepon" required class="form-control"
                                    name="telepon"></td>
                        </tr>

                        <tr>
                            <td>Alamat</td>
                            <td><input type="text" placeholder="Alamat" required class="form-control"
                                    name="alamat"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="text" placeholder="example@gmail.com" required class="form-control" name="email"></td>
                        </tr>
                        <tr>                            
                            <td><input type="text" placeholder="nik" required class="form-control"
                                    name="nik" hidden value="-"></td>
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
<!-- akhir modal tambah -->
