<?php

$bulan = array(
	'01' => 'Januari',
	'02' => 'Februari',
	'03' => 'Maret',
	'04' => 'April',
	'05' => 'Mei',
	'06' => 'Juni',
	'07' => 'Juli',
	'08' => 'Agustus',
	'09' => 'September',
	'10' => 'Oktober',
	'11' => 'November',
	'12' => 'Desember',
);

$akses = array(
	'1' => 'Admin',
	'2' => 'Tata Usaha',
	'3' => 'Kepala Sekolah',
);

function rupiah1($angka){
	$hasil_rupiah = number_format($angka, 0, ".", ".");
	return $hasil_rupiah;
}

function rupiah0($angka){
	$hasil_rupiah = "Rp " . number_format($angka, 0, ".", ".");
	return $hasil_rupiah;
}
 
function rupiah2($angka){
	$hasil_rupiah = "Rp " . number_format($angka, 1, ",", ".");
	return $hasil_rupiah;
}
 
function rupiah3($angka){
	$hasil_rupiah = "Rp " . number_format($angka, 2, ".", ",");
	return $hasil_rupiah;
}

function convertbulan($date){
	$bulan = array(
		'01' => 'Januari',
		'02' => 'Februari',
		'03' => 'Maret',
		'04' => 'April',
		'05' => 'Mei',
		'06' => 'Juni',
		'07' => 'Juli',
		'08' => 'Agustus',
		'09' => 'September',
		'10' => 'Oktober',
		'11' => 'November',
		'12' => 'Desember',
	);
	return $bulan[substr($date, 5, 2)];
}

function convertmonthtobulan($date){
	$bulan = array(
		'01' => 'Januari',
		'02' => 'Februari',
		'03' => 'Maret',
		'04' => 'April',
		'05' => 'Mei',
		'06' => 'Juni',
		'07' => 'Juli',
		'08' => 'Agustus',
		'09' => 'September',
		'10' => 'Oktober',
		'11' => 'November',
		'12' => 'Desember',
	);
	return $bulan[$date];
}

function bulanke($date){
	$bulanke = array(
		'01' => 'Bulan ke 1',
		'02' => 'Bulan ke 2',
		'03' => 'Bulan ke 3',
		'04' => 'Bulan ke 4',
		'05' => 'Bulan ke 5',
		'06' => 'Bulan ke 6',
		'07' => 'Bulan ke 7',
		'08' => 'Bulan ke 8',
		'09' => 'Bulan ke 9',
		'10' => 'Bulan ke 10',
		'11' => 'Bulan ke 11',
		'12' => 'Bulan ke 12',
	);
	return $bulanke[$date];
}

function convertinfaq($date){
	$infaq = array(
		'01' => 'Infaq ke - 7',
		'02' => 'Infaq ke - 8',
		'03' => 'Infaq ke - 9',
		'04' => 'Infaq ke - 10',
		'05' => 'Infaq ke - 11',
		'06' => 'Infaq ke - 12',
		'07' => 'Infaq ke - 1',
		'08' => 'Infaq ke - 2',
		'09' => 'Infaq ke - 3',
		'10' => 'Infaq ke - 4',
		'11' => 'Infaq ke - 5',
		'12' => 'Infaq ke - 6',
	);

	return $infaq[substr($date, 5, 2)];
}

function convertInfaqMultiple($data1, $data2){
	$infaq = array(
		'01' => '7',
		'02' => '8',
		'03' => '9',
		'04' => '10',
		'05' => '11',
		'06' => '12',
		'07' => '1',
		'08' => '2',
		'09' => '3',
		'10' => '4',
		'11' => '5',
		'12' => '6',
	);

	return $infaq[$data1].' s/d '. $infaq[$data2];
}


function convertinfaqurut($date){
	$infaq = array(
		'01' => 'Infaq ke - 1',
		'02' => 'Infaq ke - 2',
		'03' => 'Infaq ke - 3',
		'04' => 'Infaq ke - 4',
		'05' => 'Infaq ke - 5',
		'06' => 'Infaq ke - 6',
		'07' => 'Infaq ke - 1',
		'08' => 'Infaq ke - 2',
		'09' => 'Infaq ke - 3',
		'10' => 'Infaq ke - 4',
		'11' => 'Infaq ke - 5',
		'12' => 'Infaq ke - 6',
	);

	return $infaq[substr($date, 5, 2)];
}

?>