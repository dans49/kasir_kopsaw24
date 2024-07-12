<h4>naon we</h4>
<br />
<?php if(isset($_GET['success'])){?>
<div class="alert alert-success">
    <p>Tambah Data Berhasil ! TEST</p>
</div>
<?php }?>
<?php if(isset($_GET['success-edit'])){?>
<div class="alert alert-success">
    <p>Update Data Berhasil !</p>
</div>
<?php }?>
<?php if(isset($_GET['remove'])){?>
<div class="alert alert-danger">
    <p>Hapus Data Berhasil !</p>
</div>
<?php }?>
<?php 
	if(!empty($_GET['uid'])){
	$sql = "SELECT * FROM kategori WHERE id_kategori = ?";
	$row = $config->prepare($sql);
	$row->execute(array($_GET['uid']));
	$edit = $row->fetch();
?>
<form method="POST" action="fungsi/edit/edit.php?kategori=edit">
    <table>
        <tr>
            <td style="width:25pc;"><input type="text" class="form-control" value="<?= $edit['nama_kategori'];?>"
                    required name="kategori" placeholder="Masukan Kategori Barang Baru">
                <input type="hidden" name="id" value="<?= $edit['id_kategori'];?>">
            </td>
            <td style="padding-left:10px;"><button id="tombol-simpan" class="btn btn-primary"><i class="fa fa-edit"></i>
                    Edit Data</button></td>
        </tr>
    </table>
</form>
<?php }else{?>
<form method="POST" action="fungsi/tambah/tambah.php?kategori=tambah">
    <table>
        <tr>
            <td style="width:25pc;"><input type="text" class="form-control" required name="kategori"
                    placeholder="Masukan Kategori Barang Baru"></td>
            <td style="padding-left:10px;"><button id="tombol-simpan" class="btn btn-primary"><i class="fa fa-plus"></i>
                    Insert Data</button></td>
        </tr>
    </table>
</form>
<?php }?>
<br />
<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm" id="example1">
            <thead>
                <tr style="background:#DFF0D8;color:#333;">
                    <th width="7%">No.</th>
                    <th>Kategori</th>
                    <th width="20%">Tanggal Input</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
				$hasil = $lihat -> kategori();
				$no=1;
				foreach($hasil as $isi){
                    $exp = explode(' ', $isi['waktudata']);
			?>
                <tr>
                    <td><?php echo $no;?></td>
                    <td><?php echo $isi['nama_kategori'];?></td>
                    <td><?php echo $frmwaktu->tgl_indo($exp[0]); ?></td>
                    <td>
                        <a href="index.php?page=kategori&uid=<?php echo $isi['id_kategori'];?>"><button
                                class="btn btn-warning">Edit</button></a>
                        <a href="fungsi/hapus/hapus.php?kategori=hapus&id=<?php echo $isi['id_kategori'];?>"
                            onclick="javascript:return confirm('Hapus Data Kategori ?');"><button
                                class="btn btn-danger">Hapus</button></a>
                    </td>
                </tr>
                <?php $no++; }?>
            </tbody>
        </table>
    </div>
</div>