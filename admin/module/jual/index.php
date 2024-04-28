 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
<?php 
    $id = $_SESSION['admin']['id_member'];
    $hasil = $lihat -> member_edit($id);
?>
    <h4>Keranjang Penjualan</h4>
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
	<div class="row">
        <div class="col-sm-4">
            <div class="card card-primary mb-3">
                <div class="card-header bg-info text-white">
                    <i class="fa fa-search"></i> Cari Barang
                </div>
                <div class="card-body">
                    <input type="text" id="cari" class="form-control" name="cari" placeholder="Masukan : Kode / Nama Barang  [ENTER]">
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card card-info mb-3">
                <div class="card-header bg-info text-white">
                    <i class="fa fa-list"></i> Hasil Pencarian
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="hasil_cari"></div>
                        <div id="tunggu"></div>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="col-sm-12">
            <div class="card card-primary">
                <div class="card-header bg-info text-white">
                    <h5><i class="fa fa-shopping-cart"></i> KASIR
                    <a class="btn btn-danger btn-sm float-right" 
                        onclick="javascript:return confirm('Apakah anda ingin reset keranjang ?');" href="fungsi/hapus/hapus.php?penjualan=jual">
                        <b><span class="fa fa-trash"></span> Reset Keranjang</b></a>
                    </h5>
                </div>
                <div class="card-body">
                    <div id="keranjang" class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td><b>Tanggal</b></td>
                                <td><input type="text" readonly="readonly" class="form-control" value="<?php echo date("j F Y, G:i");?>" name="tgl"></td>
                            </tr>
                            <tr>
                                <td><b>Pelanggan</b></td>
                                <td>
                                    <select class="form-control select2get" name="plg">
                                        <option value="">-Pilih-</option>
                                        <?php
                                        foreach ($lihat->pelanggan() as $gdata) {
                                            echo "<option value='$gdata[nm_pelanggan]'>$gdata[nm_pelanggan]</option>";
                                        }
                                        ?>
                                    </select>
                                    <button type="button" class="btn btn-primary btn-sm mr-2"  data-toggle="modal" data-target="#myModal"><span class="fa fa-plus"></span> Tambah</button>
                                </td>
                            </tr>
                        </table>
                        <table class="table table-bordered w-100" id="example1">
                            <thead>
                                <tr>
                                    <th> No</th>
                                    <th> Nama Barang</th>
                                    <th> Merk Barang</th>
                                    <th> Harga</th>
                                    <th> Jumlah</th>
                                    <th> Total</th>
                                    <th> Kasir</th>
                                    <th> Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total_bayar=0; $no=1; $hasil_penjualan = $lihat -> temp_penjualan();?>
                                <?php foreach($hasil_penjualan  as $isi){?>
                                <tr>
                                    <td><?php echo $no;?></td>
                                    <td><?php echo $isi['nama_barang'];?></td>
                                    <td><?php echo $isi['merk'];?></td>
                                    <td>Rp. <?php echo number_format($isi['harga_jual'],0,',','.');?></td>
                                    <td>
                                        <!-- aksi ke table penjualan -->
                                        <form method="POST" action="fungsi/edit/edit.php?jual=jual">
                                            <input type="number" name="jumlah" value="<?php echo $isi['jumlah'];?>" class="form-control cjml">
                                            <input type="hidden" name="id" value="<?php echo $isi['id_temp'];?>" class="form-control">
                                            <input type="hidden" name="id_barang" value="<?php echo $isi['id_barang'];?>" class="form-control">
                                    </td>
                                    <td>Rp.<?php echo number_format($isi['total'],0,',','.');?>,-</td>
                                    <td><?php echo $isi['nm_member'];?></td>
                                    <td>
                                            <button type="submit" class="btn btn-warning">Update</button>
                                        </form>
                                        <!-- aksi ke table penjualan -->
                                        <a href="fungsi/hapus/hapus.php?jual=jual&id=<?php echo $isi['id_temp'];?>&brg=<?php echo $isi['id_barang'];?>
                                            &jml=<?php echo $isi['jumlah']; ?>"  class="btn btn-danger"><i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php 
                                $no++; 
                                $total_bayar += $isi['total'];
                                }
                                ?>
                            </tbody>
                    </table>
                    <br/>
                    <?php $hasil = $lihat -> jumlah(); ?>
                    <div id="kasirnya">
                            <?php
                            // proses bayar dan ke nota
                            if(!empty($_GET['nota'] == 'yes')) {
                                $total = $_POST['total'];
                                $bayar = $_POST['bayar'];
                                if(!empty($bayar))
                                {
                                    $hitung = $bayar - $total;
                                    if($bayar >= $total)
                                    {
                                        $id_barang = $_POST['id_barang'];
                                        $id_member = $_POST['id_member'];
                                        $getplg = $_POST['plg'];
                                        $jumlah = $_POST['jumlah'];
                                        $total = $_POST['total1'];
                                        $periode = $_POST['periode'];
                                        $jumlah_dipilih = count($id_barang);
                                        
                                        for($x=0;$x<$jumlah_dipilih;$x++){

                                            $d = array($id_barang[$x],$id_member[$x],$getplg,$jumlah[$x],$total[$x],$bayar[$x],$periode[$x]);
                                            $sql = "INSERT INTO nota (id_barang,id_member,nm_pelanggan,jumlah,total,bayaran,kembalian,status_nota,periode) VALUES(?,?,?,?,?,?)";
                                            $row = $config->prepare($sql);
                                            $row->execute($d);

                                            // ubah stok barang
                                            $sql_barang = "SELECT * FROM barang WHERE id_barang = ?";
                                            $row_barang = $config->prepare($sql_barang);
                                            $row_barang->execute(array($id_barang[$x]));
                                            $hsl = $row_barang->fetch();
                                            
                                            $stok = $hsl['stok'];
                                            $idb  = $hsl['id_barang'];

                                            $total_stok = $stok - $jumlah[$x];
                                            // echo $total_stok;
                                            $sql_stok = "UPDATE barang SET stok = ? WHERE id_barang = ?";
                                            $row_stok = $config->prepare($sql_stok);
                                            $row_stok->execute(array($total_stok, $idb));
                                        }
                                        echo '<script>alert("Belanjaan Berhasil Di Bayar !");</script>';
                                    }else{
                                        echo '<script>alert("Uang Kurang ! Rp.'.$hitung.'");</script>';
                                    }
                                }
                            }
                            ?>
                        <form method="POST" action="index.php?page=jual&nota=yes#kasirnya">
                            <?php foreach($hasil_penjualan as $isi){;?>
                                <input type="hidden" name="id_barang[]" value="<?php echo $isi['id_barang'];?>">
                                <input type="hidden" name="id_member[]" value="<?php echo $isi['id_member'];?>">
                                <input type="hidden" name="jumlah[]" value="<?php echo $isi['jumlah'];?>">
                                <input type="hidden" name="total1[]" value="<?php echo $isi['total'];?>">
                                <input type="hidden" name="tgl_input[]" value="<?php echo $isi['tanggal_input'];?>">
                                <input type="hidden" name="periode[]" value="<?php echo date('m-Y');?>">
                            <?php $no++; }?>
                        <div class="row mb-3">
                            <div class="col-sm-6">&nbsp;</div>
                            <div class="col-sm-2 text-right">Grand Total</div>
                            <div class="col-sm-4"><input type="text" id="totals" class="form-control" name="total" value="<?php echo $total_bayar;?>"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6">&nbsp;</div>
                            <div class="col-sm-2 text-right">Bayar</div>
                            <div class="col-sm-2"><input type="text" id="dibayar" class="form-control" name="bayar" value="<?php echo $bayar;?>" required></div>
                            <div class="col-sm-2">
                                <!-- <?php  if(!empty($_GET['nota'] == 'yes')) {?>
                                    <a class="btn btn-danger" href="fungsi/hapus/hapus.php?penjualan=jual">
                                    <b>RESET</b></a><?php }?> -->
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input paylater" id="customSwitch1" data-on-text="ON" data-off-text="OFF">
                                    <label class="custom-control-label" for="customSwitch1">Bayar Nanti</label>
                                </div>
                                <input type="hidden" id="status" name="status" value="">

                            </div>
                        </div>
                         <div class="row mb-3">
                            <div class="col-sm-6">&nbsp;</div>
                            <div class="col-sm-2 text-right">Kembali</div>
                            <div class="col-sm-3"><input type="text" id="kembalian" class="form-control" value="<?php echo $hitung;?>"></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-3">
                                <button class="btn btn-success btn-sm"><i class="fa fa-shopping-cart"></i> Proses Transaksi</button>
                                <a href="print.php?nm_member=<?php echo $_SESSION['admin']['nm_member'];?>
                                    &bayar=<?php echo $bayar;?>&kembali=<?php echo $hitung;?>" target="_blank" class="btn btn-secondary btn-sm btnprint">
                                        <i class="fa fa-print"></i> Print Invoice
                                </a>
                            </div>
                        </div>
                        <br/>
                        <br/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style=" border-radius:0px;">
                <div class="modal-header" style="background:#285c64;color:#fff;">
                    <h5 class="modal-title"><i class="fa fa-plus"></i> Tambah Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="fungsi/tambah/tambah.php?pelanggan_jual=tambah" method="POST">
                    <div class="modal-body">
                        <table class="table table-striped bordered">
                            <?php
                                $format = $lihat -> pelanggan_id();
                            ?>
                            <tr>
                                <td>ID Pelanggan</td>
                                <td><input type="text" readonly="readonly" required value="<?php echo $format;?>"
                                        class="form-control" name="id"></td>
                            </tr>
                            <tr>
                                <td>Nama Pelanggan*</td>
                                <td><input type="text" placeholder="Nama Pelanggan" required class="form-control"
                                        name="nama"></td>
                            </tr>
                            <tr>
                                <td>Telepon*</td>
                                <td><input type="text" placeholder="Telepon" required class="form-control"
                                        name="telepon" maxlength="15"></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><input type="email" placeholder="Email" class="form-control"
                                        name="mail"></td>
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
// AJAX call for autocomplete 
$(document).ready(function(){
    $("#cari").change(function(){
        $.ajax({
            type: "POST",
            url: "fungsi/edit/edit.php?cari_barang=yes",
            data:'keyword='+$(this).val(),
            beforeSend: function(){
                $("#hasil_cari").hide();
                $("#tunggu").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
            },
            success: function(html){
                $("#tunggu").html('');
                $("#hasil_cari").show();
                $("#hasil_cari").html(html);
            }
        });
    });
});


// ======== KONDISI AWAL =======
$("#kembalian").val('0')
$(".btnprint").hide();
// =============================


$(document).on('keyup','#dibayar', function() {
    var total = $("#totals").val()
    var bayar = $("#dibayar").val()
    var getang = 0;
    getang = bayar - total;
    
    $("#kembalian").val(getang);
});

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

$(document).on('change','.paylater', function(e) {
    let cek = e.target.checked;

    if (cek == true) {
        bayar = $("#dibayar").prop('disabled',true);
        bayar = $("#dibayar").prop('required',false);
        status = $("#status").val('Hutang');
        $(".btnprint").show();
    } else {
        bayar = $("#dibayar").prop('disabled', false);
        bayar = $("#dibayar").prop('required',true);
        status = $("#status").val('');
        $(".btnprint").hide();
    }
    $("#kembalian").val('0');
});

$(document).on('keyup','#dibayar', function() {
    let balik = $("#kembalian").val();

    if (balik < '0') {
        $("#status").val('');
        $(".btnprint").hide();
    } else {
        $("#status").val('Lunas');
        $(".btnprint").show();
    }
});

$(document).on('change','.cjml', function() {
    var jml = $(".cjml").val()
    // console.log(jml)
});

//To select country name
</script>