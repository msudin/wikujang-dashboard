<?php
include '../dbcon/config.php';
session_start();
if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Admin'){
    session_destroy();	
    $login_redirect_url = "../index.php";
    echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
}

$modal_id=$_POST['modal_id'];
$modal_name = $_POST['modal_name'];
mysqli_query($koneksi,"UPDATE tb_kelas SET nama_kelas= '$modal_name' WHERE id_kelas='$modal_id'");

// Create Log Activity  
$deskripsi = "Mengubah Kelas, ID=".$modal_name; 
$timestamp = date('d-m-Y H:i:s'); 
$aksi = "Update"; 
$userlog = $_SESSION['adm_username'];
mysqli_query($koneksi, "INSERT INTO tb_log VALUES ('$timestamp', '$aksi', '$userlog', '$deskripsi')");

// -- End Create Log --

ob_start(); 
header('location:kelas_data.php?message=edit_success');
exit();

?>