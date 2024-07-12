<?php 
$id = $_SESSION['admin']['id_member'];
$hasil = $lihat->member_edit($id);
?>
<h4>Backup & Restore Data</h4>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .btn-animated {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .btn-animated::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background-color: rgba(255, 255, 255, 0.1);
            transition: all 0.75s ease;
            transform: translate(-50%, -50%) scale(0);
            border-radius: 50%;
        }
        .btn-animated:hover::before {
            transform: translate(-50%, -50%) scale(1);
        }
        .btn-animated:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
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

<button type="button" class="btn btn-primary btn-animated mr-2" data-toggle="modal" data-target="#myModalbackup">
    <i class="fa fa-database"></i> Backup Data
</button>
<button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#myModalrestore">
    <i class="fa fa-upload"></i> Restore Data
</button>

<div id="myModalbackup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal backup content-->
        <div class="modal-content" style="border-radius: 0px;">
            <div class="modal-header" style="background: #285c64; color: #fff;">
                <h5 class="modal-title"><i class="fa fa-database"></i> Backup Data</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="fungsi/apis/apibackupcsv.php?backup_restore=backup" method="POST">
                <div class="modal-footer">
                <button type="submit" class="btn btn-warning btn-animated"><i class="fa fa-file-excel"></i>Backup Data CSV</button>
            </form> 
            <form action="fungsi/apis/apibackupsql.php?backup_restore_sql=backup" method="POST">
                <button type="submit" class="btn btn-primary btn-animated"><i class="fa fa-database"></i> Backup Data SQL</button>
            </form> <button type="button" class="btn btn-default btn-animated" data-dismiss="modal">Close</button>
                </div>
            
        </div>
    </div>
</div>
<!-- akhir modal backup -->
 <!-- Modal restore content-->
 <div id="myModalrestore" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 0px;">
            <div class="modal-header" style="background: #285c64; color: #fff;">
                <h5 class="modal-title"><i class="fa fa-plus"></i> Restore Database </h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="fungsi/apis/apirestoresql.php?backup_restore=restore" method="POST" enctype="multipart/form-data">
            <div class="modal-footer">
                <input type="file" name="restore_file" accept=".sql" required>
                <button hidden type="submit" class="btn btn-success"><i class="fa fa-data"></i>Restore Sekarang</button>
            </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            
        </div>
    </div>
</div>
<!-- akhir restore backup -->
