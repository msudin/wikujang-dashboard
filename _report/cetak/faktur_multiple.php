<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
if (empty($_SESSION['user_id'])){
  session_destroy();	
  $login_redirect_url = "../../index.php";
  echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
};

include '../../utils/lib.php'; 
include '../../dbcon/config.php';

  $user_id = $_SESSION['user_id'];
  $username = mysqli_query($koneksi, "select * from admin where id_admin='$user_id'");
  $dataid = mysqli_fetch_array($username);
  
  if(isset($_POST['modal_id'])){
	$id_nis = $_POST['modal_id'];
	$tahun = $_POST['tahun']; 
	$bulan1 = $_POST['bulan1']; 
	$bulan2 = $_POST['bulan2'];
	$tahun1 = $tahun."-".$bulan1; 
    $tahun2 = $tahun."-".$bulan2; 
    
  }
  $sql = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran INNER JOIN tb_siswa ON tb_pembayaran.nis_bayar=tb_siswa.id_nis WHERE nis_bayar='$id_nis' AND bulan_bayar between '$tahun1' AND '$tahun2' ORDER BY id_bayar Desc LIMIT 1 ");  
  $ds = mysqli_fetch_array($sql); 


  //-----------------------------------------------------"""""""""""""""""""""""""""""""""""""""""""""""""""--------------------
  $sql1 = mysqli_query($koneksi, "SELECT SUM(nominal_bayar) FROM tb_pembayaran  WHERE nis_bayar='$id_nis' AND bulan_bayar between '$tahun1' AND '$tahun2'"); 
  $total = mysqli_fetch_array($sql1); 
  $jumlah_tagihan = $total[0]; 	
?>
<html>

<head>
    <meta charset="utf-8" />
    <title>Faktur Pembayaran</title>
    <link href="w3.css" rel="stylesheet" />
    <style>
    #tabel {
        font-size: 15px;
        border-collapse: collapse;
    }

    #tabel td {
        padding-left: 5px;
        border: 0px solid transparent;
    }

    tr.border_bottom td {
        border-bottom: 1pt solid black;

    }

    tr.border_topbottom td {
        border-bottom: 1pt solid black;
        border-top: 1pt solid black;
    }
	</style>
	
	<style>
    /* Center the loader Loading Page Style*/
    #loader {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 150px;
        height: 150px;
        margin: -75px 0 0 -75px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;

    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Add animation to "page content" */

    .animate-bottom {
        position: relative;
        -webkit-animation-name: animatebottom;
        -webkit-animation-duration: 1s;
        animation-name: animatebottom;
        animation-duration: 1s
    }

    @-webkit-keyframes animatebottom {
        from {
            bottom: -100px;
            opacity: 0
        }

        to {
            bottom: 0px;
            opacity: 1
        }
    }

    @keyframes animatebottom {
        from {
            bottom: -100px;
            opacity: 0
        }

        to {
            bottom: 0;
            opacity: 1
        }
    }

    #myDiv {
        display: none;
    }
    </style>
</head>

<body onload="myFunction()" style="margin:0;">
  
    <div>
        <table style='width:280px; font-family:calibri; font-size:11pt; border-collapse: collapse;' border='0'>
            <tr align='center'>
                <td><b><span style='font-size:12pt'>SMA NEGERI 1 BANGIL </span></b></td>
            </tr>
            <tr align="center">
                <td>Jl. Bader No 3. Kalirejo Bangil. </td>
			</tr>
			<tr align="center">
                <td>Telp. (0343)741873</td>
            </tr>
            <tr class="border_bottom">
                <td colspan='3'></td>
            </tr>
		</table>
        <table style='width:280px; font-size:9pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <tr align='center'>
                <td><b><span style='font-size:11pt'>SLIP PEMBAYARAN </span></b></td>
            </tr>
        </table>
        <table style='width:280px; font-size:9pt; font-family:calibri; border-collapse: collapse;' border='0'>
		<td align='left' style=' vertical-align:top; width:150px'>
                <table style=' border-collapse: collapse;'>
                    <tr>
                        <td style='font-size:11pt; width:50px'>No.Trx</td>
                        <td width='1%' style='font-size:11pt'>:</td>
                        <td style='font-size:11pt; padding-left:4px;'><?php echo $ds['id_bayar'];  ?></td>
                    </tr>
                    <tr>
                        <td style='font-size:11pt; width:50px'>Tanggal</td>
                        <td width='1%' style='font-size:11pt'>:</td>
                        <td style='font-size:11pt; padding-left:4px;'><?php echo date("d-m-Y"); ?></td>
                    </tr>
                </table>
            </td>
        </table>
        <table style='width:280px; font-size:9pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td align='left' style=' vertical-align:top; width:100px'>
                <table style=' border-collapse: collapse;'>
                    <tr>
                        <td style='font-size:11pt; width:50px'>NIS</td>
                        <td width='1%' style='font-size:11pt'>:</td>
                        <td style='font-size:11pt; padding-left:4px;'><?php echo $ds['nis_bayar']; ?> / <?php echo $ds['kls_bayar']; ?></td>
                    </tr>
                </table>
            </td>
			
        </table>
        <table style='width:280px; font-size:9pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <tr>
                <td style='font-size:11pt; width:50px'>Nama</td>
                <td width='1%' style='font-size:11pt'>:</td>
                <td style='font-size:11pt; padding-left:4px;'><?php echo $ds['nama_siswa']; ?></td>
            </tr>
		</table><br>
        <table style='width:280px; font-size:11pt; font-family:calibri;  border-collapse: collapse; padding-top:50px;'>
            <tr class="border_topbottom">
                <td width='5%' align="left">No</td>
                <td width='70%' style='padding-left:10px; text-align:left;'>Pembayaran</td>
                <td width='25%' style='padding-right:20px; text-align:right;'>Jumlah</td>
            </tr>
            <tr>
                <td style='text-align:left;'>1</td>
                <td style='padding-left:10px; text-align:left;'>Titipan Infaq ke - <?php echo $bulan1." s/d ".$bulan2; ?></td>
                <td style='padding-right:1px; text-align:left;'><?php echo rupiah0($jumlah_tagihan); ?></td>
			</tr>
			<tr>
                <td style='text-align:left;'></td>
                <td style='padding-left:10px; text-align:left;'></td>
                <td style='padding-right:1px; text-align:left;'></td>
            </tr>
            <tr style='height:20px;'>
                <td colspan='3'> </td>
            </tr>
            <tr class="border_bottom">
                <td colspan='3'></td>
            </tr>
        </table></br>
        <?php 
function penyebut($nilai) {
	$nilai = abs($nilai);
	$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
	$temp = "";
	if ($nilai < 12) {
		$temp = " ". $huruf[$nilai];
	} else if ($nilai <20) {
		$temp = penyebut($nilai - 10). " Belas";
	} else if ($nilai < 100) {
		$temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
	} else if ($nilai < 200) {
		$temp = " Seratus" . penyebut($nilai - 100);
	} else if ($nilai < 1000) {
		$temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
	} else if ($nilai < 2000) {
		$temp = " Seribu" . penyebut($nilai - 1000);
	} else if ($nilai < 1000000) {
		$temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
	} else if ($nilai < 1000000000) {
		$temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
	} else if ($nilai < 1000000000000) {
		$temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
	} else if ($nilai < 1000000000000000) {
		$temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
	}     
	return $temp;
}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}
 
 
	$angka = 1530093;
	?>
        <table cellspacing='0' style='width:280px; height:30px; font-size:11pt; font-family:calibri;  border-collapse: collapse; padding-top:20px; margin-top:-20px;  margin-bottom:10px;'>
            <tr align="center" class="border_bottom">
                <td colspan='3'>
                    <div style='text-align:left; padding-left:10px;'><i> Terbilang :
					<?php echo terbilang($jumlah_tagihan)." Rupiah"; ?></span></i></div>
                </td>
            </tr>
        </table>
        <table style='width:400px; font-family:calibri; font-size:11pt;' >
            <tr>
                <td></td>
                <td></td>
                <td align='center'>TTD,</br></br></br><u>(<?php echo $dataid['adm_fullname']; ?>)</u></td>
            </tr>
        </table>
	</div>
</div>
<script  type="text/javascript" src="../../SiteAssets/calculation.js"></script>
<script>

    function myFunction() {
        window.print();
    };
</script>
</body>

</html>