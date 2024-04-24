<?php
function temp_id($koneksi)
{
	$sql = "select max(right(id_temp,3)) as kode from _temp_penjualan where year(waktudata)=year(now()) and month(waktudata)=month(now())";
	$row = $koneksi -> prepare($sql);
    $row -> execute(array($id));
    $hasil = $row -> fetch();

    if($hasil['kode'] == NULL || $hasil['kode'] == 0){
		$sql2 = "select concat(date_format(now(),'TE%d%m%Y.'),lpad(count(id_temp)+1,4,0)) as kode from _temp_penjualan where year(waktudata)=year(now()) and month(waktudata)=month(now())";
		$row = $koneksi -> prepare($sql2);
		$row -> execute(array($id));
		$hasil = $row -> fetch();
		
	} else {
		$sql2 = "select concat(date_format(now(),'TE%d%m%Y.'),lpad(max(right(id_temp,4))+1,4,0)) as kode from _temp_penjualan where year(waktudata)=year(now()) and month(waktudata)=month(now())";
		$row = $koneksi -> prepare($sql2);
		$row -> execute(array($id));
		$hasil = $row -> fetch();
	}

	return $hasil['kode'];
}

