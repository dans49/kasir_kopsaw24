<?php
function temp_id($koneksi)
{
	$sql = "select max(right(id_temp,3)) as kode from _temp_penjualan where year(waktudata)=year(now()) and month(waktudata)=month(now())";
	$row = $koneksi -> prepare($sql);
    $row -> execute();
    $hasil = $row -> fetch();

    if($hasil['kode'] == NULL || $hasil['kode'] == 0){
		$sql2 = "select concat(date_format(now(),'TE%m%Y.'),lpad(count(id_temp)+1,3,0)) as kode from _temp_penjualan where year(waktudata)=year(now()) and month(waktudata)=month(now())";
		$row = $koneksi -> prepare($sql2);
		$row -> execute();
		$hasil = $row -> fetch();
		
	} else {
		$sql2 = "select concat(date_format(now(),'TE%m%Y.'),lpad(max(right(id_temp,3))+1,3,0)) as kode from _temp_penjualan where year(waktudata)=year(now()) and month(waktudata)=month(now())";
		$row = $koneksi -> prepare($sql2);
		$row -> execute();
		$hasil = $row -> fetch();
	}

	return $hasil['kode'];
}

function getnota($koneksi)
{
	$sql = "select max(right(id_nota,4)) as kode from nota where year(waktudata)=year(now()) and month(waktudata)=month(now())";
	$row = $koneksi -> prepare($sql);
    $row -> execute();
    $hasil = $row -> fetch();

    if($hasil['kode'] == NULL || $hasil['kode'] == 0){
		$sql2 = "select concat(date_format(now(),'TRX%m%Y.'),lpad(count(id_nota)+1,4,0)) as kode from nota where year(waktudata)=year(now()) and month(waktudata)=month(now())";
		$row = $koneksi -> prepare($sql2);
		$row -> execute();
		$hasil = $row -> fetch();
		
	} else {
		$sql2 = "select concat(date_format(now(),'TRX%m%Y.'),lpad(max(right(id_nota,4))+1,4,0)) as kode from nota where year(waktudata)=year(now()) and month(waktudata)=month(now())";
		$row = $koneksi -> prepare($sql2);
		$row -> execute();
		$hasil = $row -> fetch();
	}

	return $hasil['kode'];
}

function getpenjualan($koneksi)
{
	$sql = "select max(right(id_penjualan,4)) as kode from penjualan where year(waktudata)=year(now()) and month(waktudata)=month(now())";
	$row = $koneksi -> prepare($sql);
    $row -> execute();
    $hasil = $row -> fetch();

    if($hasil['kode'] == NULL || $hasil['kode'] == 0){
		$sql2 = "select concat(date_format(now(),'PJ%m%Y.'),lpad(count(id_penjualan)+1,4,0)) as kode from penjualan where year(waktudata)=year(now()) and month(waktudata)=month(now())";
		$row = $koneksi -> prepare($sql2);
		$row -> execute();
		$hasil = $row -> fetch();
		
	} else {
		$sql2 = "select concat(date_format(now(),'PJ%m%Y.'),lpad(max(right(id_penjualan,4))+1,4,0)) as kode from penjualan where year(waktudata)=year(now()) and month(waktudata)=month(now())";
		$row = $koneksi -> prepare($sql2);
		$row -> execute();
		$hasil = $row -> fetch();
	}

	return $hasil['kode'];
}

