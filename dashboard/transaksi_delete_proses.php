<?php
include "../dbcon/config.php";

session_start();
if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Admin'){
    session_destroy();	
    $login_redirect_url = "../index.php";
    echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
}

$modal_id=$_GET['modal_id'];
$select = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE id_bayar='$modal_id'"); 
$slt = mysqli_fetch_array($select); 
$nis_slt = $slt['nis_bayar']; 
$bulan_slt = $slt['bulan_bayar'];

$modal =mysqli_query($koneksi,"Delete FROM tb_pembayaran WHERE id_bayar='$modal_id'");

// Create Log Activity  
$deskripsi = "Menghapus Transaksi Pembayaran, ID=".$modal_id."NIS =".$nis_slt."Bulan =".$bulan_slt; 
$timestamp = date('d-m-Y H:i:s'); 
$aksi = "Delete"; 
$userlog = $_SESSION['adm_username'];
mysqli_query($koneksi, "INSERT INTO tb_log VALUES ('$timestamp', '$aksi', '$userlog', '$deskripsi')");

// -- End Create Log --

ob_start();
header('location:transaksi_data_all.php?message=delete_success');
exit();
?>