<?php
session_start();
require '../../config.php';

$stat = $_GET['status'];

if($stat == 'hari') {
	$_SESSION['lap_nota'] = 'hari';
} elseif($stat == 'bulan') {
	$_SESSION['lap_nota'] = 'bulan';
} elseif($stat == 'tahun') {
	$_SESSION['lap_nota'] = 'tahun';
} else {
	$_SESSION['lap_nota'] = '';
}

echo $_SESSION['lap_nota'];