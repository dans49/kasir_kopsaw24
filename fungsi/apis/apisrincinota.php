<?php
session_start();
require '../../config.php';
require '../../fungsi/view/view.php';
$lihat = new view($config);

$nota = $_GET['nota'];
$member = $_GET['memberid'];
$status = $_GET['status'];
// echo $nota;
// return 0;

$sql ="SELECT * FROM nota WHERE id_nota = ?
        ORDER BY id_nota DESC";
$row = $config -> prepare($sql);
$row -> execute(array($nota));
$hasil = $row -> fetch();

$hasil2 = $lihat -> rincian_nota($nota);
$nom = 1;
$getjual = "";
$getbayar = "";
$total2=0;
$total3=0;
$bayar = 0;
$jumlah = 0;
$modal = 0;

foreach ($hasil2 as $isi2) {

   $sql2 ="SELECT * FROM penjualan WHERE id_nota='$isi2[id_nota]' AND id_barang='$isi2[id_barang]'";
   $row2 = $config -> prepare($sql2);
   $row2 -> execute();
   $qjumlah = $row2 -> fetch();

   $jumlahpcs = $qjumlah['jumlah'];
   $total2 +=  $isi2['total_pembelian'];
   $total3 +=  $isi2['total_pembelian'];
   $sisa = $total2-$isi2['bayar'];
   $bayar2 = $isi2['bayar'];
   $id_nota = $isi2['id_nota'];

   $getjual .= "<tr>";
   $getjual .= "<td>$nom</td>";
   $getjual .= "<td>$isi2[nama_barang]</td>";
   $getjual .= "<td>$isi2[diskon]</td>";
   $getjual .= "<td>$jumlahpcs</td>";
   $getjual .= "<td>Rp. ".number_format($isi2['total_pembelian'],0,',','.').",-</td>";
   $getjual .= "</tr>";
   $nom++;
}

if($status=="Lunas"){ 
   if($bayar2==0){ $kembali = "0";} else{ $kembali = $bayar2-$total2;}
   $getbayar .= "<div class='pull-right'>
          Total : Rp. $total2,-
          <br/>
          Bayar : Rp. $bayar2,-
          <br/>
          Kembali : Rp. $kembali,-
      </div>
      ";
   } else {
   $getbayar .= "<form method='POST' id='bayar_hutang' action='fungsi/edit/edit.php?nota=edit' ><div class='row'>                            
          <div class='col-sm-2.5 '>Total :</div>
          <div class='col-sm-4'>Rp. $total2 ,-</div>
      </div>
      
      <div class='row'>                            
         <div class='col-sm-2.5 '>Bayar :</div>
         <div class='col-sm-4'><input type='number' id='bayar' class='form-control' name='bayar' value='$sisa' required></div>

         <input type='text' name='total_blj' value= '$total2' hidden>
         <input type='text' name='status_nota' value= 'Lunas' hidden >
         <input type='text' name='id_nota' value= '$nota' hidden >
         <div class='col-sm-3'>
         <button type='submit' class='btn btn-success btn-sm-2'><i class='fa fa-shopping-cart '></i> Bayar </button>                      
       </div>                           
   </div>
</form>";
}

$data = array(
   'nota' => $hasil['id_nota'],
   'total' => $hasil['total'],
   'bayar' => $hasil['bayar'],
   'kembali' => $hasil['kembalian'],
   'penjualan' => $getjual,
   'getbayar' => $getbayar
);
echo json_encode($data);