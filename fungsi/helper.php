<?php
function kodesiswa($koneksi)
{
	$newprod = $koneksi->query("select max(right(idsiswa,3)) as kode from ql_siswa where year(waktudata)=year(now()) and month(waktudata)=month(now())");
	$get = mysqli_fetch_array($newprod);
	if($get['kode'] == NULL || $get['kode'] == 0){
		$newprod = $koneksi->query("select concat(date_format(now(),'%Y%m'),lpad(count(idsiswa)+1,3,0)) as kode from ql_siswa where year(waktudata)=year(now()) and month(waktudata)=month(now())");
		$get = mysqli_fetch_array($newprod);
		
	} else {
		$newprod = $koneksi->query("select concat(date_format(now(),'%Y%m'),lpad(max(right(idsiswa,3))+1,3,0)) as kode from ql_siswa where year(waktudata)=year(now()) and month(waktudata)=month(now())");
		$get = mysqli_fetch_array($newprod);
	}

	return $get['kode'];
}

