<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
if (empty($_SESSION['user_id'])){
  session_destroy();	
  $login_redirect_url = "../../index.php";
  echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
}

	include '../../utils/lib.php'; 
    include '../../dbcon/config.php';

	$user_id = $_SESSION['user_id'];
	$username = mysqli_query($koneksi, "select * from admin where id_admin='$user_id'");
	$dataid = mysqli_fetch_array($username);


	
	$get_tgl=$_GET['tgl'];
	$hari = substr($get_tgl, 8,2); 
	$kelas=$_GET['kelas'];
	$bulta = substr($get_tgl, 3,7); 
	$month_value = substr($get_tgl, 5, 2); 
	$month_year = $bulan[$month_value]." ".substr($get_tgl, 0,4);  
	$setymd = $hari."-".$month_value."-".substr($get_tgl, 0,4); 

	if($_GET['kelas'] == 'Pilih Kelas' || $_GET['kelas']== 'All' ){
  
	$data_transaksi = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran INNER JOIN tb_siswa ON tb_pembayaran.nis_bayar=tb_siswa.id_nis WHERE tgl_bayar LIKE '%$get_tgl%' ORDER BY nis_bayar ASC"); 

	$total_trans = mysqli_query($koneksi, "SELECT SUM(nominal_bayar) FROM tb_pembayaran INNER JOIN tb_siswa ON tb_pembayaran.nis_bayar=tb_siswa.id_nis WHERE tgl_bayar LIKE '%$get_tgl%' ORDER BY id_bayar DESC"); 
	$total = mysqli_fetch_array($total_trans); 
	$transaksi_nominal = $total[0]; 	

	} else if($_GET['kelas'] != 'Pilih Kelas' || $_GET['kelas'] != 'ALL'){

	$data_transaksi = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran INNER JOIN tb_siswa ON tb_pembayaran.nis_bayar=tb_siswa.id_nis WHERE tgl_bayar LIKE '%$get_tgl%' AND kls_siswa='$kelas' ORDER BY nis_bayar ASC"); 
	
	$total_trans = mysqli_query($koneksi, "SELECT SUM(nominal_bayar) FROM tb_pembayaran INNER JOIN tb_siswa ON tb_pembayaran.nis_bayar=tb_siswa.id_nis WHERE tgl_bayar LIKE '%$get_tgl%' AND kls_siswa='$kelas' ORDER BY id_bayar DESC"); 
	$total = mysqli_fetch_array($total_trans); 
	$transaksi_nominal = $total[0]; 	
	}
	
?>
<html>
<head>
<meta charset="utf-8"/>
<title>Faktur Pembayaran</title>
<link href="w3.css" rel="stylesheet"/>
<style>

#tabel
{
font-size:15px;
border-collapse:collapse;
}
#tabel  td
{
padding-left:5px;
border:0px solid transparent;
}

tr.border_bottom td {
  border-bottom:1pt solid black;
 
}

tr.border_topbottom td {
  border-bottom:1pt solid black;
  border-top:1pt solid black;
}
</style>
</head>
<body  onload="myFunction()" style="margin:0;">
	 <!-- <div class="w3-right footer">
        <button id="print" class="w3-button w3-blue">Cetak Bukti Pembayaran</button>
    </div> -->
	<div class="container">
<center>
<table style='font-size:12pt; font-family:calibri; border-collapse: collapse;' border = '0'>
	<tr style='text-align:center;'>
		<td><b>SMA NEGERI 1 BANGIL</b></td>
	</tr>
	<tr style='text-align:center;'> 
		<td>Jl. Bader No 3. Kalirejo Bangil. Telp (0343)741873</td>
	</tr>
</table>
<hr  style='width:680px;' size="2px" color="black">
<table style='font-size:12pt; font-family:calibri; border-collapse: collapse;' border = '0'>
	<tr style='text-align:center;'>
		<td><b>REKAP PEMBAYARAN</b></td>
	</tr>
</table>
<table style='width:680px; font-size:9pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td width='60%' align='left' style='padding-right:80px; vertical-align:top'>
	<table style=' border-collapse: collapse;'>
	<tr> 
		<td width='15%' style='font-size:11pt'>Tanggal</td>
		<td width='1%' style='font-size:11pt'>:</td>
		<td style='font-size:11pt; padding-left:4px;'><?php echo $setymd; ?></td>
	</tr>
	<tr> 
		<td width='15%' style='font-size:11pt'>Bulan</td>
		<td width='1%' style='font-size:11pt'>:</td>
		<td style='font-size:11pt; padding-left:4px;'><?php echo $month_year; ?></td>
	</tr>
</table>
</td>
<td style='vertical-align:top' width='40%' align='left'>
<table style=' border-collapse: collapse;'>
	<tr> 
		<td width='15%' style='font-size:11pt'>Kelas</td>
		<td width='1%' style='font-size:11pt'>:</td>
		<td style='font-size:11pt; padding-left:4px;'><?php echo $kelas; ?></td>
	</tr>
</table>
</td>
</table><br>

<?php

if($_GET['kelas'] != 'All'){
?>
<table cellspacing='0'  style='width:680px; font-size:11pt; font-family:calibri;  border-collapse: collapse; padding-top:50px;'  >
	<tr class="border_topbottom">
		<td width='5%' align="left">No</td>
		<td width='15%' style='padding-left:10px; text-align:left;'>NIS</td>
		<td width='60%' style='padding-left:10px; text-align:left;'>Nama</td>
		<td width='10%' style='padding-left:10px; text-align:left;'>L/P</td>
		<td width='20%' style='padding-right:50px; text-align:right;'>Keterangan</td>
	</tr>
	<?php 
  	 $no = 0; 
	while($dt=mysqli_fetch_array($data_transaksi)){
	$no++;

	//$bulan_bayar= $bulan[substr($dt['bulan_bayar'], 0,2)]." ".substr($dt['bulan_bayar'], 3,4);
	$bulan_bayar= $bulan[substr($dt['bulan_bayar'], 5,2)]." ".substr($dt['bulan_bayar'], 0,4);

	?>
	<tr>
		<td style='text-align:left;'><?php echo $no; ?></td>
		<td style='padding-left:10px; text-align:left;'><?php echo $dt['nis_bayar']; ?> </td>
		<td style='padding-left:10px; text-align:left;'><?php echo $dt['nama_siswa']; ?></td>
		<td style='padding-left:10px; text-align:left;'><?php echo $dt['jk_siswa']; ?></td>
		<td style='padding-leftt:10px; text-align:left;'>PB <?php echo $dt['bulan_bayar']; ?></td>
	</tr>
	<?php 
	}
	?>
	<tr style='height:20px;'>
		<td colspan='5'> </td>
	</tr>
	<tr class="border_topbottom" style='height:25px;'>
		<td colspan='5'><i>Total Pembayaran : <?php echo rupiah0($transaksi_nominal); ?></i></td>
	</tr>
	<tr>
		<td colspan='5' style='font-size:9pt; height:30px;'><i>Versi Cetak : <?php echo date('d-m-y H:i:s'); ?></i></td>
	</tr>
</table></br>


<?php 
} elseif ($_GET['kelas'] == 'All'){
?>

<table cellspacing='0'  style='width:680px; font-size:11pt; font-family:calibri;  border-collapse: collapse; padding-top:50px;'  >
	<tr class="border_topbottom">
		<td width='5%' align="left">No</td>
		<td width='15%' style='padding-left:10px; text-align:left;'>NIS</td>
		<td width='60%' style='padding-left:10px; text-align:left;'>Nama</td>
		<td width='20%' style='padding-left:10px; text-align:left;'>Kelas</td>
		<td width='10%' style='padding-left:10px; text-align:left;'>L/P</td>
		<td width='10%' style='padding-right:50px; text-align:right;'>Keterangan</td>
	</tr>
	<?php 
  	 $no = 0; 
	while($dt=mysqli_fetch_array($data_transaksi)){
	$no++;

	//$bulan_bayar= substr($dt['bulan_bayar'], 5,2)." ".substr($dt['bulan_bayar'], 0,4);

	?>
	<tr>
		<td style='text-align:left;'><?php echo $no; ?></td>
		<td style='padding-left:10px; text-align:left;'><?php echo $dt['nis_bayar']; ?> </td>
		<td style='padding-left:10px; text-align:left;'><?php echo $dt['nama_siswa']; ?></td>
		<td style='padding-left:10px; text-align:left;'><?php echo $dt['kls_siswa']; ?></td>
		<td style='padding-left:10px; text-align:left;'><?php echo $dt['jk_siswa']; ?></td>
		<td style='padding-leftt:10px; text-align:left;'>PB <?php echo $dt['bulan_bayar']; ?></td>
	</tr>
	<?php 
	}
	?>
	<tr style='height:20px;'>
		<td colspan='6'> </td>
	</tr>
	<tr class="border_topbottom" style='height:25px;'>
		<td colspan='6'><i>Total Pembayaran : <?php echo rupiah0($transaksi_nominal); ?></i></td>
	</tr>
	<tr>
		<td colspan='6' style='font-size:9pt; height:30px;'><i>Versi Cetak : <?php echo date('d-m-y H:i:s'); ?></i></td>
	</tr>
</table></br>

<?php 
}
?>
</center>
</div>

<script>
	 function myFunction() {
		window.print();
	};
</script>


</body>
</html>