<?php
session_start();
if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Admin'){
    session_destroy();
    $login_redirect_url = "../index.php";
    echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
}

include "../dbcon/config.php";
$kelas_name = $_POST['kelas_name'];
mysqli_query($koneksi,"INSERT INTO tb_kelas (id_kelas,nama_kelas) VALUES (NULL,'$kelas_name')");

// Create Log Activity  
$deskripsi = "Menambahkan Kelas, ID=".$kelas_name; 
$timestamp = date('d-m-Y H:i:s'); 
$aksi = "Insert"; 
$userlog = $_SESSION['adm_username'];
mysqli_query($koneksi, "INSERT INTO tb_log VALUES ('$timestamp', '$aksi', '$userlog', '$deskripsi')");

// -- End Create Log --

ob_start();
header('location:kelas_data.php?message=add_success');
exit();

?>
