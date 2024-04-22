<?php
/**
 * 
 */
class Waktu 
{
	var $day;
	var $month;

	public function setDay($hari) {
		if($hari == '1') {
			$this->day = 'Senin';
		}
		if($hari == '2') {
			$this->day = 'Selasa';
		}
		if($hari == '3') {
			$this->day = 'Rabu';
		}
		if($hari == '4') {
			$this->day = 'Kamis';
		}
		if($hari == '5') {
			$this->day = 'Jumat';
		}
		if($hari == '6') {
			$this->day = 'Sabtu';
		}
		if($hari == '7') {
			$this->day = 'Minggu';
		}
	}

	public function getDay() {
		return $this->day;
	}

	public function setMonth($bulan) {
		if($bulan == '1') {
			$this->month = 'Januari';
		}
		if($bulan == '2') {
			$this->month = 'Februari';
		}
		if($bulan == '3') {
			$this->month = 'Maret';
		}
		if($bulan == '4') {
			$this->month = 'April';
		}
		if($bulan == '5') {
			$this->month = 'Mei';
		}
		if($bulan == '6') {
			$this->month = 'Juni';
		}
		if($bulan == '7') {
			$this->month = 'Juli';
		} 
		if($bulan == '8') {
			$this->month = 'Agustus';
		}
		if($bulan == '9') {
			$this->month = 'September';
		}
		if($bulan == '10') {
			$this->month = 'Oktober';
		}
		if($bulan == '11') {
			$this->month = 'Nopember';
		}
		if($bulan == '12') {
			$this->month = 'Desember';
		}
	}

	public function getMonth() {
		return $this->month;
	}

	public function tgl_indo($tanggal)
	{
		$tgl = explode('-', $tanggal);
		$this->setMonth($tgl[1]);
		return $tgl[2].' '.$this->getMonth().' '.$tgl[0];
	}
}


// $da = new Waktu;
// $t = date('2023-11-20');
// echo "bulan ini ".$da->tgl_indo($t);