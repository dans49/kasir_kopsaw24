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
                <div class="card-header bg-success text-white">
                    <i class="fa fa-search"></i> Cari Barang
                </div>
                <div class="card-body">
                    <input type="text" id="cariBarang" class="form-control" name="cari" placeholder="Masukan : Kode / Nama Barang  [ENTER]">
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card card-info mb-3">
                <div class="card-header bg-success text-white">
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
                <div class="card-header bg-success text-white">
                    <h5><i class="fa fa-shopping-cart"></i> KASIR
                    <a class="btn btn-danger btn-sm float-right" 
                        onclick="javascript:return confirm('Apakah anda ingin reset keranjang ?');" href="fungsi/hapus/hapus.php?restok_barang=yes">
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
                                <?php 
                                    $total_bayar=0; 
                                    $no=1; 
                                    $restok = $lihat -> temp_restok();
                                    foreach($restok  as $isi){
                                ?>
                                <tr>
                                    <td><?php echo $no;?></td>
                                    <td><?php echo $isi['nama_barang'];?></td>
                                    <td><?php echo $isi['merk'];?></td>
                                    <td>Rp. <?php echo number_format($isi['harga_jual'],0,',','.');?></td>
                                    <td>
                                        <!-- aksi ke table penjualan -->
                                        <form method="POST" action="fungsi/edit/edit.php?restok_barang=yes">
                                            <input type="number" name="jumlah" value="<?php echo $isi['jumlah'];?>" class="form-control cjml">
                                            <input type="hidden" name="id" value="<?php echo $isi['id_trestok'];?>" class="form-control">
                                            <input type="hidden" name="id_barang" value="<?php echo $isi['id_barang'];?>" class="form-control">
                                    </td>
                                    <td>Rp.<?php echo number_format($isi['total'],0,',','.');?>,-</td>
                                    <td><?php echo $isi['nm_member'];?></td>
                                    <td>
                                            <button type="submit" class="btn btn-warning">Update</button>
                                        </form>
                                        <!-- aksi ke table penjualan -->
                                        <a href="fungsi/hapus/hapus.php?beli_restok=del&id=<?php echo $isi['id_trestok'];?>&brg=<?php echo $isi['id_barang'];?>&jml=<?php echo $isi['jumlah']; ?>"  class="btn btn-danger"><i class="fa fa-times"></i>
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
                            if(!empty($_GET['beli'] == 'yes')) {
                                $total = $_POST['total'];
                                $bayar = $_POST['bayar'] ?? '0';
                                $kembali = $_POST['kembalian'];
                                $jml2 = 0;
                                $tot2 = 0;
                                
                                if(!empty($bayar) || $bayar == '0')
                                {
                                    $hitung = $bayar - $total;

                                    $idnota = getnota($config);
                                    $id_barang = $_POST['id_barang'];
                                    $id_member = $_POST['id_member'];
                                    $jumlah = $_POST['jumlah'];
                                    $total = $_POST['total1'];
                                    $periode = $_POST['periode'];
                                    $jumlah_dipilih = count($id_barang);
                                    
                                    for($x=0;$x<$jumlah_dipilih;$x++){

                                        $idstok = getstok($config);
                                        $id_supplier = $_POST['supplier'];
                                        $d = array($idstok,$id_barang[$x],$id_supplier,$id_member[$x],$jumlah[$x],$total[$x]);
                                        $sql = "INSERT INTO restok_barang (id_getstok,id_barang,id_supplier,id_member,jumlah,total) VALUES(?,?,?,?,?,?)";
                                        $row = $config->prepare($sql);
                                        $row->execute($d);

                                        // ubah stok barang
                                        $sql_barang = "SELECT * FROM barang WHERE id_barang = ?";
                                        $row_barang = $config->prepare($sql_barang);
                                        $row_barang->execute(array($id_barang[$x]));
                                        $hsl = $row_barang->fetch();
                                        
                                        $stok = $hsl['stok'];
                                        $idb  = $hsl['id_barang'];

                                        $total_stok = $stok + $jumlah[$x];
                                        // echo $total_stok;
                                        $sql_stok = "UPDATE barang SET stok = ? WHERE id_barang = ?";
                                        $row_stok = $config->prepare($sql_stok);
                                        $row_stok->execute(array($total_stok, $idb));

                                        $jml2 = $jml2 + $jumlah[$x];
                                        $tot2 = $tot2 + $total[$x];
                                        $perio = $periode[$x];
                                        $member = $id_member[$x];
                                    }

                                    // $d2 = array($idnota,$member,$getplg,$jml2,$tot2,$bayar,$kembali,$status,$perio);
                                    // $sql2 = "INSERT INTO nota (id_nota,id_member,id_pelanggan,jumlah,total,bayar,kembalian,status_nota,periode) VALUES(?,?,?,?,?,?,?,?,?)";
                                    // $row2 = $config->prepare($sql2);
                                    // $row2->execute($d2);

                                    echo '<script>alert("Belanjaan Berhasil Di Bayar !");</script>';
                                    
                                }
                            }
                            ?>
                        <form method="POST" id="subrestok" action="#" > 
                            <?php foreach($restok as $isi){;?>
                                <input type="hidden" name="id_barang[]" value="<?php echo $isi['id_barang'];?>">
                                <input type="hidden" name="id_member[]" value="<?php echo $isi['id_member'];?>">
                                <input type="hidden" name="jumlah[]" value="<?php echo $isi['jumlah'];?>">
                                <input type="hidden" name="total1[]" value="<?php echo $isi['total'];?>">
                                <input type="hidden" name="tgl_input[]" value="<?php echo $isi['tanggal_input'];?>">
                                <input type="hidden" name="periode[]" value="<?php echo date('m-Y');?>">
                            <?php $no++; }?>
                        <div class="row mb-3">
                            <div class="col-sm-6">&nbsp;</div>
                            <div class="col-sm-2 text-right"><h3>Total </h3></div>
                            <div class="col-sm-4">
                                <input type="hidden" id="totals" class="form-control" name="total" value="<?php echo $total_bayar;?>">
                                <h3>Rp. <span id="gettotal"><?php echo number_format($total_bayar,0,',','.');?></span>,-</h3>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6">&nbsp;</div>
                            <div class="col-sm-2 text-right">Supplier</div>
                            <div class="col-sm-4">
                                <select class="form-control select2get" name="supplier" required>
                                    <option value="">-Pilih-</option>
                                    <?php
                                    foreach ($lihat->supplier() as $suppdata) {
                                        echo "<option value='$suppdata[id_supplier]'>$suppdata[nama_supplier]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
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

    <div id="myStuff" class="modal fade" role="dialog">
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
    $("#cariBarang").change(function(){
        $.ajax({
            type: "POST",
            url: "fungsi/edit/edit.php?cari_stok_barang=yes",
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
    $('#subrestok').on('submit', function(e){
        e.preventDefault();
        let idm = "<?php echo $_SESSION['admin']['id_member']; ?>"

        $.ajax({
            type: 'POST',
            url: "index.php?page=restok&beli=yes",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response){
                $.ajax({
                    url: "fungsi/hapus/hapus.php?restok_barang=del",
                    method: "GET",
                    success: function() {
                        alert('Stok barang sudah ditambahkan!')
                        location.reload();
                    }
                })

                // $.ajax({
                //     type: 'GET',
                //     url: "fungsi/apis/apisnota.php?memberid="+idm,
                //     dataType: 'json',
                //     success: function(res) {
                        // $("#trx").html(res.nota)
                        // $("#gettotal").html(numberWithCommas(res.total))
                        // $("#getbayar").html(numberWithCommas(res.bayar))
                        // $("#getkembali").html(numberWithCommas(res.kembali))
                        // $("#dataTrx").html(res.penjualan)
                        // $("#printinv").prop("href","print.php?nota="+res.nota)
                //     }
                // })
                // $("#myStuff").modal('show')
            }
        });
    });

});


// ======== KONDISI AWAL =======
$(".btnprint").hide();
// =============================

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

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