<?php
session_start();
require '../../config.php';

$member = $_GET['memberid'];

$sql ="SELECT _temp_penjualan.* , barang.id_barang, barang.nama_barang, barang.merk, barang.harga_jual, member.id_member,
        member.nm_member from _temp_penjualan 
        left join barang on barang.id_barang=_temp_penjualan.id_barang 
        left join member on member.id_member=_temp_penjualan.id_member
        ORDER BY id_temp";
$row = $config -> prepare($sql);
$row -> execute();
$hasil = $row -> fetchAll();

$sql2 ="SELECT * FROM penjualan
		INNER JOIN barang ON barang.id_barang=penjualan.id_barang
		WHERE penjualan.id_nota = ?";
$row2 = $config -> prepare($sql2);
$row2 -> execute(array($hasil['id_nota']));
$hasil2 = $row2 -> fetchAll();
$nom = 1;
$getjual = "";
foreach ($hasil2 as $value) {
   $getjual .= "<tr>";
   $getjual .= "<td>$nom</td>";
   $getjual .= "<td>$value[nama_barang]</td>";
   $getjual .= "<td>$value[merk]</td>";
   $getjual .= "<td>".number_format($value['jumlah'],0,',','.')."</td>";
   $getjual .= "<td>Rp. ".number_format($value['total'],0,',','.').",-</td>";
   $getjual .= "</tr>";
}

$data = array(
		'nota' => $hasil['id_nota'],
		'total' => $hasil['total'],
		'bayar' => $hasil['bayar'],
		'kembali' => $hasil['kembalian'],
		'penjualan' => $getjual
		);
echo json_encode($data);