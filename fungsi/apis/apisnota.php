<?php
session_start();
require '../../config.php';

$member = $_GET['memberid'];

$sql ="SELECT * FROM nota WHERE id_member = ?
        ORDER BY id_nota DESC";
$row = $config -> prepare($sql);
$row -> execute(array($member));
$hasil = $row -> fetch();

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
	$getjual .= "<td>$value[jumlah]</td>";
	$getjual .= "<td>$value[total]</td>";
	$getjual .= "</tr>";
	$nom++;
}

$data = array(
			'nota' => $hasil['id_nota'],
			'total' => $hasil['total'],
			'bayar' => $hasil['bayar'],
			'kembali' => $hasil['kembalian'],
			'penjualan' => $getjual
		);
echo json_encode($data);