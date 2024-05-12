<?php
session_start();
require '../../config.php';

$year = $_GET['tahun'];

$gt[] = $year;

$sql2 ="SELECT sum(total) from _temp_penjualan WHERE _temp_penjualan.id_member = ?";
$row2 = $config -> prepare($sql2);
$row2 -> execute($gt);
$hasil2 = $row2 -> fetch();

// foreach ($hasil as $value) {
    $data['total'] = $hasil2;
// }

echo json_encode($data);