<?php
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



?>