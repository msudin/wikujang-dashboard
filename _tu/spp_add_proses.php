<?php
session_start();
if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Admin'){
    session_destroy();	
    $login_redirect_url = "../index.php";
    echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
}

include "../dbcon/config.php";
$nilai_spp = trim($_POST['nominal_spp']);
$simpan = str_replace(".", "", $nilai_spp);
if(is_numeric($simpan) == TRUE){
    mysqli_query($koneksi,"INSERT INTO tb_spp VALUES (NULL,'$simpan')");

    // Create Log Activity  
    $deskripsi = "Menambahkan SPP, ID=".$nilai_spp; 
    $timestamp = date('d-m-Y H:i:s'); 
    $aksi = "Insert"; 
    $userlog = $_SESSION['adm_username'];
    mysqli_query($koneksi, "INSERT INTO tb_log VALUES ('$timestamp', '$aksi', '$userlog', '$deskripsi')");

    // -- End Create Log --

    ob_start();
    header('location:spp_default.php?message=add_success');
    exit();
} else {
    ob_start();
    header('location:spp_default.php?message=add_failed');
    exit();
}

?>