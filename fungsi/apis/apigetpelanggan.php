<?php
session_start();
require '../../config.php';

$pelanggan = $_GET['idp'];

$gt[] = $pelanggan;

$sql2 ="SELECT * from ksw_pelanggan WHERE id_pelanggan = ?";
$row2 = $config -> prepare($sql2);
$row2 -> execute($gt);
$hasil = $row2 -> fetchAll();

foreach ($hasil as $value) {
    $get['id'] = $value['id_pelanggan'];
    $get['nama'] = $value['nm_pelanggan'];
    $get['identitas'] = $value['identitas'];
    $get['telepon'] = $value['telepon'];
    if($value['statusdata'] == 'AKTIF') {
        $get['status'] = "<option value='AKTIF' selected>AKTIF</option>
                            <option value='TIDAK'>TIDAK AKTIF</option>";
    } else {
        $get['status'] = "<option value='AKTIF'>AKTIF</option>
                            <option value='TIDAK' selected>TIDAK AKTIF</option>";
    }
    $data[] = $get;
}

echo json_encode($data);