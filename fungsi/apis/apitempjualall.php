<?php
session_start();
require '../../config.php';

$member = $_GET['memberid'];

$gt[] = $member;

$sql ="SELECT _temp_penjualan.* , barang.id_barang, barang.nama_barang, barang.merk, barang.harga_jual, member.id_member,
        member.nm_member from _temp_penjualan 
        left join barang on barang.id_barang=_temp_penjualan.id_barang 
        left join member on member.id_member=_temp_penjualan.id_member
        WHERE _temp_penjualan.id_member = ?";
$row = $config -> prepare($sql);
$row -> execute($gt);
$hasil = $row -> fetchAll();

foreach ($hasil as $value) {
    $data['data'] = $hasil;
}

echo json_encode($data);