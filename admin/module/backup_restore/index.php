<?php 
$id = $_SESSION['admin']['id_member'];
$hasil = $lihat->member_edit($id);
?>
<h4>Backup & Restore Data</h4>
<br>
<?php if (isset($_GET['backup']) && $_GET['backup'] === 'backup'): ?>
<div class="alert alert-success">
    <p>Backup Data Berhasil !</p>
    <p>Buka folder C:/xampp/htdocs/kasir_kopsaw24/admin/module/backup_restore</p>
</div>
<?php endif; ?>
<?php if (isset($_GET['restore']) && $_GET['restore'] === 'restore'): ?>
<div class="alert alert-danger">
    <p>Restore Data Berhasil !</p>
</div>
<?php endif; ?>

<button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#myModalbackup">
    <i class="fa fa-plus"></i> Backup Data
</button>
<button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#myModalrestore">
    <i class="fa fa-plus"></i> Restore Data
</button>

<div id="myModalbackup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal backup content-->
        <div class="modal-content" style="border-radius: 0px;">
            <div class="modal-header" style="background: #285c64; color: #fff;">
                <h5 class="modal-title"><i class="fa fa-plus"></i> Backup Data</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="fungsi/apis/apibackupcsv.php?backup_restore=backup" method="POST">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i>Backup Data CSV</button>
                    </form> <form action="fungsi/apis/apibackupsql.php?backup_restore_sql=backup" method="POST">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Backup Data SQL</button>
                    </form> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            
        </div>
    </div>
</div>
<!-- akhir modal tambah -->
