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
                        onclick="javascript:return confirm('Apakah anda ingin reset keranjang ?');" href="fungsi/hapus/hapus.php?penjualan_jual=jual">
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
                                <?php foreach($hasil_penjualan  as $isi){
                                    ?>
                                <tr>
                                    <td><?php echo $no;?></td>
                                    <td><?php echo $isi['nama_barang'];?></td>
                                    <td><?php echo $isi['merk'];?></td>
                                    <td>Rp. <?php echo number_format($isi['harga_jual'],0,',','.');?></td>
                                    <td>
                                        <!-- aksi ke table penjualan -->
                                        <form method="POST" action="fungsi/edit/edit.php?jual=jual">
                                            <input type="number" name="jumlah" value="<?php echo $isi['jumlah'];?>" class="form-control cjml" data-id="<?php echo $isi['id_temp'];?>" data-id-barang="<?php echo $isi['id_barang'];?>" data-member="<?php echo $isi['id_member'];?>">
                                            <input type="hidden" name="id" value="<?php echo $isi['id_temp'];?>" class="form-control">
                                            <input type="hidden" name="id_barang" value="<?php echo $isi['id_barang'];?>" class="form-control">
                                    </td>
                                    <td>Rp. <span class="totaltemp<?=$no?>" data-id3="<?= $isi['id_temp'];?>"><?php echo number_format($isi['total'],0,',','.');?></span>,-
                                        
                                        <input type="hidden" name="totaltemp" id="coltotal<?=$no ?>" data-id2="<?php echo $isi['id_temp'];?>" value="<?php echo $isi['total'];?>" class="form-control">
                                    </td>
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
                                <input type="hidden" name="no" value="<?php echo $no; ?>" class="gnomor">
                            </tbody>
                    </table>
                    <br/>
                    <?php $hasil = $lihat -> jumlah(); ?>
                    <div id="kasirnya">
                            <?php
                            // proses bayar dan ke nota
                            if(!empty($_GET['nota'] == 'yes')) {
                                $total = $_POST['total'];
                                $bayar = $_POST['bayar'] ?? '0';
                                $kembali = $_POST['kembalian'];
                                $jml2 = 0;
                                $tot2 = 0;
                                $status = $_POST['status'] ?? 'Lunas';
                                if(!empty($bayar) || $bayar == '0')
                                {
                                    $hitung = $bayar - $total;

                                    $idnota = getnota($config);
                                    $id_barang = $_POST['id_barang'];
                                    $id_member = $_POST['id_member'];
                                    $getplg = $_POST['plg'];
                                    $jumlah = $_POST['jumlah'];
                                    $total = $_POST['total1'];
                                    $periode = $_POST['periode'];
                                    $jumlah_dipilih = count($id_barang);
                                    
                                    for($x=0;$x<$jumlah_dipilih;$x++){

                                        $idjual = getpenjualan($config);
                                        $d = array($idjual,$id_barang[$x],$id_member[$x],$idnota,$jumlah[$x],$total[$x]);
                                        $sql = "INSERT INTO penjualan (id_penjualan,id_barang,id_member,id_nota,jumlah,total) VALUES(?,?,?,?,?,?)";
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

                                        $jml2 = $jml2 + $jumlah[$x];
                                        $tot2 = $tot2 + $total[$x];
                                        $perio = $periode[$x];
                                        $member = $id_member[$x];
                                    }

                                    $d2 = array($idnota,$member,$getplg,$jml2,$tot2,$bayar,$kembali,$status,$perio);
                                    $sql2 = "INSERT INTO nota (id_nota,id_member,id_pelanggan,jumlah,total,bayar,kembalian,status_nota,periode) VALUES(?,?,?,?,?,?,?,?,?)";
                                    $row2 = $config->prepare($sql2);
                                    $row2->execute($d2);

                                    echo '<script>alert("Belanjaan Berhasil Di Bayar !");</script>';
                                    
                                }
                            }
                            ?>
                        <form method="POST" id="subkasir" action="#" > <!-- index.php?page=jual&nota=yes#kasirnya -->
                            <?php foreach($hasil_penjualan as $isi){;?>
                                <input type="hidden" name="id_barang[]" value="<?php echo $isi['id_barang'];?>">
                                <input type="hidden" name="id_member[]" value="<?php echo $isi['id_member'];?>">
                                <input type="hidden" name="jumlah[]" value="<?php echo $isi['jumlah'];?>">
                                <input type="text" name="total1[]" class="totalg1" value="<?php echo $isi['total'];?>">
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
                            <div class="col-sm-2 text-right">Pelanggan *Opsi</div>
                            <div class="col-sm-2">
                                <select class="form-control select2get" name="plg">
                                    <option value="">-Pilih-</option>
                                    <?php
                                    foreach ($lihat->pelanggan() as $gdata) {
                                        echo "<option value='$gdata[id_pelanggan]'>$gdata[nm_pelanggan]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-primary btn-sm mr-2"  data-toggle="modal" data-target="#myModal"><span class="fa fa-plus"></span> Tambah</button>
                            </div>
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
                            <div class="col-sm-3"><input type="text" id="kembalian" name="kembalian" class="form-control" value="<?php echo $hitung;?>"></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-shopping-cart"></i> Proses Transaksi</button>
                                <!-- <a href="print.php?nm_member=<?php echo $_SESSION['admin']['nm_member'];?>
                                    &bayar=<?php echo $bayar;?>&kembali=<?php echo $hitung;?>" target="_blank" class="btn btn-secondary btn-sm btnprint">
                                        <i class="fa fa-print"></i> Print Invoice
                                </a> -->
                            </div>
                        </div>
                        </form>
                        <br/>
                        <br/>
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
                                <td>Identitas*</td>
                                <td><input type="text" placeholder="Identitas" class="form-control"
                                        name="identitas"></td>
                            </tr>
                            <tr>
                                <td>Telepon*</td>
                                <td><input type="text" placeholder="Telepon" required class="form-control"
                                        name="telepon" maxlength="15"></td>
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

    <div id="myKasir" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style=" border-radius:0px;">
                <div class="modal-header" style="background:#285c64;color:#fff;">
                    <h5 class="modal-title"> Detail Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="fungsi/tambah/tambah.php?pelanggan_jual=tambah" method="POST">
                    <div class="modal-body">
                            <center>KPRI Sawangan</center>
                            <center>Bappelitbangda Kab. Tasikmalaya</center>
                            <center>Tanggal : <?php  echo date("j F Y, G:i"); ?></center>
                        <table width="100%" class="mt-2">
                            <tr>
                                <td>TRX</td>
                                <td>: <span id="trx"></span></td>
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
                                    <td>Merk</td>
                                    <td>Jumlah</td>
                                    <td>Total</td>
                                </tr>
                            </thead>
                            <tbody id="dataTrx"></tbody>
                        </table>
                        <div class="pull-right">
                            <?php $hasil = $lihat -> jumlah(); ?>
                            Total : Rp. <span id="gettotal"></span>,-
                            <br/>
                            Bayar : Rp. <span id="getbayar"></span>,-
                            <br/>
                            Kembali : Rp. <span id="getkembali"></span>,-
                        </div>
                        <div class="clearfix"></div>
                        <center>
                            <p>Terima Kasih Telah berbelanja di toko kami !</p>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <!-- <a href="" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print</a> -->
                        <a href="#" id="printinv" target="_blank" class="btn btn-secondary btn-sm btnprint">
                                <i class="fa fa-print"></i> Print Invoice
                        </a>
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

$(document).ready(function(){
    $('#subkasir').on('submit', function(e){
        e.preventDefault();
        let idm = "<?php echo $_SESSION['admin']['id_member']; ?>"

        $.ajax({
            type: 'POST',
            url: "index.php?page=jual&nota=yes",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response){
                $.ajax({
                    type: 'GET',
                    url: "fungsi/apis/apisnota.php?memberid="+idm,
                    dataType: 'json',
                    success: function(res) {
                        $("#trx").html(res.nota)
                        $("#gettotal").html(numberWithCommas(res.total))
                        $("#getbayar").html(numberWithCommas(res.bayar))
                        $("#getkembali").html(numberWithCommas(res.kembali))
                        $("#dataTrx").html(res.penjualan)
                        $("#printinv").prop("href","print.php?nota="+res.nota)
                    }
                })
                $("#myKasir").modal('show')
            }
        });
    });

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
        $("#dibayar").prop('readonly',true);
        $("#dibayar").prop('required',false);
        $("#dibayar").val(0);
        $("#status").val('Hutang');
        $(".btnprint").show();
    } else {
        $("#dibayar").prop('readonly', false);
        $("#dibayar").prop('required',true);
        $("#status").val('');
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

var nomor = $('.gnomor').val()

$(document).on('change keyup','.cjml', function() {
    var idt = $(this).data('id')
    var idbarang = $(this).data('id-barang')
    var memberid = $(this).data('member')
    var jml = $(this).val()

    for (var i = 1; i < nomor; i++) {
        if(idt == $('#coltotal'+i).data('id2')) {
            // console.log($('#coltotal'+i).val())
            // console.log(jml)
            $.ajax({
                url: "fungsi/edit/edit.php?jual=jual",
                method: "POST",
                data: {
                    id : idt,
                    id_barang : idbarang,
                    jumlah : jml
                },
                success: function (res) {
                    if(jml < 1) {
                        alert ("Minimal Harus memilih 1 jumlah barang atau dihapus!")
                    } else {
                        if (res == 1) {
                            // AJAX RELOAD HTML
                            $.ajax({
                                type: 'GET',
                                url: "fungsi/apis/apitemppenjualan.php?memberid="+memberid+"&idt="+idt,
                                dataType: 'json',
                                success: function(response) {
                                    // console.log(response.data[4])
                                    // console.log(i)
                                    for (var j = 1; j < nomor; j++) {
                                        if(idt == $('.totaltemp'+j).data('id3')) {
                                            $(".totaltemp"+j).html(numberWithCommas(response.data[4]))
                                        }
                                    }
                                }

                            })

                            // AJAX RELOAD KOLOM
                            $.ajax({
                                type: 'GET',
                                url: "fungsi/apis/apitempjualall.php?memberid="+memberid,
                                dataType: 'json',
                                success: function(response) {
                                    console.log(response.data[4])
                                    // console.log(i)
                                    // for (var j = 1; j < nomor; j++) {
                                    //     if(idt == $('.totaltemp'+j).data('id3')) {
                                    //         $(".totaltemp"+j).html(numberWithCommas(response.data[4]))
                                    //     }
                                    // }
                                }

                            })
                            

                        } else {
                            alert ("Keranjang Melebihi Stok Barang Anda !")
                            location.reload()
                        }
                    }
                }
            })
        }
    }
});

//To select country name
</script>