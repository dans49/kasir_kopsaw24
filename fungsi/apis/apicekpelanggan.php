<?php
session_start();
require '../../config.php';

$pelanggan = $_GET['idpil'];

$gt[] = $pelanggan;

$sql2 ="SELECT * from ksw_pelanggan WHERE id_pelanggan = ?";
$row2 = $config -> prepare($sql2);
$row2 -> execute($gt);
$hasil = $row2 ->fetch();

$data['status'] = $hasil['statusdata'];

echo json_encode($data);