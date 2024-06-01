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
                    <td><?php echo $isi['identitas'];?></td>
                    <td><?php echo $isi['telepon'];?></td>
                    <td><?php echo $isi['statusdata'];?></td>
    
                    <td>

                        <a href="fungsi/hapus/hapus.php?pelanggan=hapus&id=<?php echo $isi['id_pelanggan'];?>"
                            onclick="javascript:return confirm('Hapus Data Pelanggan ?');"><button
                                class="btn btn-danger">Hapus</button></a>

                        <a href="#" data-toggle="modal" data-target="#myModalEdit" class="btn btn-warning editpel" data-id="<?php echo $isi['id_pelanggan'];?>">Edit</a>
                        <!-- awal modal edit pelanggan -->
                        <div id="myModalEdit" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content" style=" border-radius:0px;">
                                    <div class="modal-header" style="background:#285c64;color:#fff;">
                                        <h5 class="modal-title"><i class="fa fa-plus"></i> Tambah Pelanggan</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <form action="fungsi/edit/edit.php?pelanggan=yes" method="POST" >
                                        <div class="modal-body">
                                            <table class="table table-striped bordered">
                                          
                                                    
                                                    <input type="text" value="<?=$isi['id_pelanggan']?>" class="form-control" name="id" hidden readonly>
                                               
                                               
                                                <tr>
                                                    <td>Nama Pelanggan</td>
                                                    <td><input type="text" placeholder="Nama Pelanggan" value="<?= $isi['nm_pelanggan']?>" required class="form-control"
                                                            name="nm_pelanggan"></td>
                                                </tr>
                                                <tr>
                                                    <td>Identitas</td>
                                                    <td><input type="text" value="<?=$isi['identitas']?>" placeholder="Identitas" required class="form-control" name="identitas"></td>
                                                </tr>
                                                <tr>
                                                    <td>Nomor HP</td>
                                                    <td><input type="number" value="<?=$isi['telepon']?>" placeholder="No HP" required class="form-control"
                                                            name="telepon"></td>
                                                </tr>
                                                <tr>
                                                    <td>Status</td>
                                                    <td><select name="status" class="form-control" placeholder="" required>
                                                    <option value="" hidden></option>
                        							<option value="AKTIF" <?=($isi['statusdata'] == 'AKTIF' ? 'selected':'')?>>AKTIF</option> 
                            						<option value="TIDAK" <?=($isi['statusdata'] == 'TIDAK' ? 'selected':'') ?> >TIDAK AKTIF</option>
                        							
                        	    					</select></td>
                                                </tr>
                                               
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Update
                                                Data</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
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
							$format = $lihat -> pelanggan_id();
						?>
                        <tr>
                            <td>ID Pelanggan</td>
                            <td><input type="text" readonly="readonly" required value="<?php echo $format;?>" class="form-control" name="id"></td>
                        </tr>
                       
                        <tr>
                            <td>Nama Pelanggan</td>
                            <td><input type="text" placeholder="Nama Pelanggan" required class="form-control"
                                    name="nm_pelanggan"></td>
                        </tr>
                        <tr>
                            <td>Identitas</td>
                            <td><input type="text" placeholder="Identitas" required class="form-control" name="identitas"></td>
                        </tr>
                        <tr>
                            <td>Nomor HP</td>
                            <td><input type="number" placeholder="No HP" required class="form-control"
                                    name="telepon"></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td> <input type="text" readonly="readonly" required value="AKTIF" class="form-control" name="statusdata"></td>
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



<script>
    $(document).ready(function(){

        $(".editpel").on('click',function() {
            var idpelanggan = $(this).data("id")
             $.ajax({
                type: 'GET',
                url: "fungsi/apis/apigetpelanggan.php?idp="+idpelanggan,
                dataType: "json",
                success: function(res){
                    $("#idpel").val(res[0].id)
                    $("#nmpel").val(res[0].nama)
                    $("#identitas").val(res[0].identitas)
                    $("#telepon").val(res[0].telepon)
                    $("#status").html(res[0].status)
                }
            });
        })

        $('#myKasir').on('hidden.bs.modal', function () {
            $.ajax({
                url: "fungsi/hapus/hapus.php?penjualan_jual=jual",
                method: "GET",
                success: function() {
                    location.reload();
                }
            })
        })
    });
</script>