<?php
include "../dbcon/config.php";

session_start();
if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Admin'){
    session_destroy();	
    $login_redirect_url = "../index.php";
    echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
}

$modal_id=$_GET['modal_id'];
$select = mysqli_query($koneksi, "SELECT * FROM tb_spp WHERE id_spp='$modal_id'"); 
$slt = mysqli_fetch_array($select); 
$id_slt = $slt['nominal_spp'];


$modal =mysqli_query($koneksi,"Delete FROM tb_spp WHERE id_spp='$modal_id'");

// Create Log Activity  
$deskripsi = "Menghapus SPP, ID=".$modal_id."Value=".$id_slt; 
$timestamp = date('d-m-Y H:i:s'); 
$aksi = "Delete"; 
$userlog = $_SESSION['adm_username'];
mysqli_query($koneksi, "INSERT INTO tb_log VALUES ('$timestamp', '$aksi', '$userlog', '$deskripsi')");

// -- End Create Log --

ob_start();
header('location:spp_default.php?message=delete_success');
exit();
?>