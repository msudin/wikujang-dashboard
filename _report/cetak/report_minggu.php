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



	$kelas_value=$_GET['kelas']; 

	if($_GET['set_tgl'] == "Pilih Tanggal"){
		//$login_redirect_url = "../../index.php";
		echo "
		<script> alert('Silahkan Pilih Tanggal Yang Akan Dicetak !'); </script>";
  		//echo "<script>alert('Silahkan Pilih Tanggal Yang Akan Dicetak !'); window.location = '$login_redirect_url'</script>";
	} else {
		$bulan1 = substr($_GET['set_tgl'], 0,2);
		$hari1 =  substr($_GET['set_tgl'], 3,2);
		$tahun1 = substr($_GET['set_tgl'], 6,4);
		$jam1 = "00:00:00"; 
		$date1_value = $hari1."-".$bulan1."-".$tahun1." ".$jam1;
		$qry1_value = $tahun1."-".$bulan1."-".$hari1." ".$jam1;
		$tgl1 = $hari1."/".$bulan1."/".$tahun1; 
		$bulta1 = $tahun1."-".$bulan1;

		$bulan2 = substr($_GET['set_tgl'], 13,2);
		$hari2 =  substr($_GET['set_tgl'], 16,2);
		$tahun2 = substr($_GET['set_tgl'], 19  ,4);
		$jam2 = "23:59:59"; 
		$date2_value = $hari2."-".$bulan2."-".$tahun2." ".$jam2;
		$qry2_value = $tahun2."-".$bulan2."-".$hari2." ".$jam2;
		$tgl2 = $hari2."/".$bulan2."/".$tahun2; 
		$get_tgl = $tgl1." - ".$tgl2; 
		$bulta2 = $tahun2."-".$bulan2;
	}

	if($_GET['kelas'] == 'Pilih Kelas' || $_GET['kelas']== 'All' ){  

	$bulan1 = substr($_GET['set_tgl'], 0,2);
	$hari1 =  substr($_GET['set_tgl'], 3,2);
	$tahun1 = substr($_GET['set_tgl'], 6,4);
	$jam1 = "00:00:00"; 
	$date1_value = $hari1."-".$bulan1."-".$tahun1." ".$jam1;
	$qry1_value = $tahun1."-".$bulan1."-".$hari1." ".$jam1;
	$tgl1 = $hari1."/".$bulan1."/".$tahun1; 
	$bulta1 = $tahun1."-".$bulan1;

	$bulan2 = substr($_GET['set_tgl'], 13,2);
	$hari2 =  substr($_GET['set_tgl'], 16,2);
	$tahun2 = substr($_GET['set_tgl'], 19  ,4);
	$jam2 = "23:59:59"; 
	$date2_value = $hari2."-".$bulan2."-".$tahun2." ".$jam2;
	$tgl2 = $hari2."/".$bulan2."/".$tahun2; 
	$bulta2 = $tahun2."-".$bulan2;
	$qry2_value = $tahun2."-".$bulan2."-".$hari2." ".$jam2;
	$data_transaksi = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran INNER JOIN tb_siswa ON tb_pembayaran.nis_bayar=tb_siswa.id_nis WHERE  tgl_bayar between '$qry1_value' AND '$qry2_value' ORDER BY id_bayar DESC"); 
	$nominal_pb = mysqli_query($koneksi, "SELECT SUM(nominal_bayar) FROM tb_pembayaran INNER JOIN tb_siswa ON tb_pembayaran.nis_bayar=tb_siswa.id_nis WHERE tgl_bayar between '$qry1_value' AND '$qry2_value' ORDER BY id_bayar DESC"); 

	}else if($_GET['kelas'] != 'Pilih Kelas' || $_GET['kelas'] != 'ALL'){

	$bulan1 = substr($_GET['set_tgl'], 0,2);
	$hari1 =  substr($_GET['set_tgl'], 3,2);
	$tahun1 = substr($_GET['set_tgl'], 6,4);
	$jam1 = "00:00:00"; 
	$date1_value = $hari1."-".$bulan1."-".$tahun1." ".$jam1;
	$qry1_value = $tahun1."-".$bulan1."-".$hari1." ".$jam1;
	$tgl1 = $hari1."/".$bulan1."/".$tahun1; 
	$bulta1 = $tahun1."-".$bulan1;

	$bulan2 = substr($_GET['set_tgl'], 13,2);
	$hari2 =  substr($_GET['set_tgl'], 16,2);
	$tahun2 = substr($_GET['set_tgl'], 19  ,4);
	$jam2 = "23:59:59"; 
	$date2_value = $hari2."-".$bulan2."-".$tahun2." ".$jam2;
	$tgl2 = $hari2."/".$bulan2."/".$tahun2; 
	$bulta2 = $tahun2."-".$bulan2;
	$qry2_value = $tahun2."-".$bulan2."-".$hari2." ".$jam2;
	$data_transaksi = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran INNER JOIN tb_siswa ON tb_pembayaran.nis_bayar=tb_siswa.id_nis WHERE  kls_siswa='$kelas_value' AND tgl_bayar between '$qry1_value' AND '$qry2_value'  ORDER BY id_bayar DESC");
	$nominal_pb = mysqli_query($koneksi, "SELECT SUM(nominal_bayar) FROM tb_pembayaran INNER JOIN tb_siswa ON tb_pembayaran.nis_bayar=tb_siswa.id_nis WHERE  kls_siswa='$kelas_value' AND tgl_bayar between '$qry1_value' AND '$qry2_value'  ORDER BY id_bayar DESC");
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
<body onload="myFunction()" style="margin:0;">
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
		<td><b>REKAP PEMBAYARAN </b></td>
	</tr>
</table>
<table style='width:680px; font-size:9pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td width='60%' align='left' style='padding-right:80px; vertical-align:top'>
	<table style=' border-collapse: collapse;'>
	<tr> 
		<td width='15%' style='font-size:11pt'>Tanggal</td>
		<td width='1%' style='font-size:11pt'>:</td>
		<td style='font-size:11pt; padding-left:4px;'><?php echo $get_tgl; ?></td>
	</tr>
	<tr> 
		<td width='15%' style='font-size:11pt'>Bulan</td>
		<td width='1%' style='font-size:11pt'>:</td>
		<td style='font-size:11pt; padding-left:4px;'><?php echo $bulan[$bulan1]." ".$tahun1; ?></td>
	</tr>
</table>
</td>
<td style='vertical-align:top' width='40%' align='left'>
<table style=' border-collapse: collapse;'>
	<tr> 
		<td width='15%' style='font-size:11pt'>Kelas</td>
		<td width='1%' style='font-size:11pt'>:</td>
		<td style='font-size:11pt; padding-left:4px;'><?php echo $kelas_value; ?></td>
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
		<td width='50%' style='padding-left:10px; text-align:left;'>Nama</td>
		<td width='5%' style='padding-left:10px; text-align:left;'>L/P</td>
		<td width='25%' style='padding-left:40px; text-align:left;'>Keterangan</td>
	</tr>
	<?php 
		
		$total = mysqli_fetch_array($nominal_pb); 
		$transaksi_nominal = $total[0]; 		
	
  	$no = 0; 
	while($dt=mysqli_fetch_array($data_transaksi)){
	$no++;

	//$bulan_bayar= $bulan[substr($dt['bulan_bayar'], ,2)]." ".substr($dt['bulan_bayar'], 3,4);
	$bulan_bayar = $dt['bulan_bayar'];

	?>
	<tr>
		<td style='text-align:left;'><?php echo $no; ?></td>
		<td style='padding-left:10px; text-align:left;'><?php echo $dt['nis_bayar']; ?> </td>
		<td style='padding-left:10px; text-align:left;'><?php echo $dt['nama_siswa']; ?></td>
		<td style='padding-left:10px; text-align:left;'><?php echo $dt['jk_siswa']; ?></td>
		<td style='padding-left:40px; text-align:left;'>PB <?php echo $dt['bulan_bayar']; ?></td>
	</tr>
	<?php 
	}
	?>
	<tr style='height:20px;'>
		<td colspan='5'> </td>
	</tr>
	<tr class="border_topbottom" style='height:30px;'>
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
		<td width='43%' style='padding-left:10px; text-align:left;'>Nama</td>
		<td width='15%' style='padding-left:10px; text-align:left;'>Kelas</td>
		<td width='5%' style='padding-left:10px; text-align:left;'>L/P</td>
		<td width='30%' style='padding-left:20px; text-align:left;'>Keterangan</td>
	</tr>
	<?php 

	$total = mysqli_fetch_array($nominal_pb); 
	$transaksi_nominal = $total[0]; 	

  	 $no = 0; 
	while($dt=mysqli_fetch_array($data_transaksi)){
	$no++;

	// $bulan_bayar= $bulan[substr($dt['bulan_bayar'], 0,2)]." ".substr($dt['bulan_bayar'], 3,4);
	?>
	<tr>
		<td style='text-align:left;'><?php echo $no; ?></td>
		<td style='padding-left:10px; text-align:left;'><?php echo $dt['nis_bayar']; ?> </td>
		<td style='padding-left:10px; text-align:left;'><?php echo $dt['nama_siswa']; ?></td>
		<td style='padding-left:10px; text-align:left;'><?php echo $dt['kls_siswa']; ?></td>
		<td style='padding-left:10px; text-align:left;'><?php echo $dt['jk_siswa']; ?></td>
		<td style='padding-left:20px; text-align:left;'><?php echo $bulan[substr($dt['bulan_bayar'],5,2)]; ?></td>
	</tr>
	<?php 
	}
	?>
	<tr style='height:20px;'>
		<td colspan='6'> </td>
	</tr>
	<tr class="border_topbottom"  style='height:30px;'>
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

<!-- <script src="jquery.min.js"></script>
    <script src="printThis.js"></script>
    <script>
        $('#print').click(function(){
            $('.container').printThis({
                debug: false,           // show the iframe for debugging
                importCSS: true,        // import parent page css
                importStyle: true,     // import style tags
                printContainer: true,   // print outer container/$.selector
                loadCSS: "file:///C:/Users/TedirGhazali/Documents/Plugin/print-web-page/w3.css",      // load an additional css file - load multiple stylesheets with an array []
                pageTitle: "Print My Document",          // add title to print page
                removeInline: false,    // remove all inline styles
                printDelay: 333,        // variable print delay
                         // prefix to html
                footer: null,           // postfix to html
                formValues: true,       // preserve input/form values
                canvas: false,          // copy canvas content (experimental)
                base: false,            // preserve the BASE tag, or accept a string for the URL
                doctypeString: '<!DOCTYPE html>', // html doctype
                removeScripts: false,   // remove script tags before appending
                copyTagClasses: false   // copy classes from the html & body tag
            });
        })
    </script> -->
<script>
	 function myFunction() {
		window.print();
	}
</script>
</body>
</html>