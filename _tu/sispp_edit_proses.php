<?php
include '../dbcon/config.php';
session_start();
if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Tata Usaha'){
    session_destroy();	
    $login_redirect_url = "../index.php";
    echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
}

$modal_id=$_POST['modal_id'];
$keterangan = $_POST['modal_keterangan']; 

if ($_POST['nominal_spp_auto'] != "manual"){
    //echo "Tidak ada nominal";
    $nomi = $_POST['nominal_spp_auto']; 
    mysqli_query($koneksi,"UPDATE tb_siswa SET nominal_spp='$nomi' WHERE id_nis='$modal_id'" );
   
    ob_start(); 
    header('location:sispp_data.php?message=edit_success');
    exit();
} elseif ($_POST['nominal_spp_auto'] == "manual"){
    if($_POST['nominal_spp'] == null){
        $nomi1 = $_POST['modal_spp'];
        $simpan = str_replace("Rp", "", $nomi1);
    } else {
        $simpan = $_POST['nominal_spp'];
    }
  
    $nomi = str_replace(".", "", $simpan);
    mysqli_query($koneksi,"UPDATE tb_siswa SET nominal_spp='$nomi',  ket_siswa='$keterangan' WHERE id_nis='$modal_id' " );

    // Create Log Activity  
    $deskripsi = "Merubah SPP, ID=".$modal_id; 
    $timestamp = date('d-m-Y H:i:s'); 
    $aksi = "Update"; 
    $userlog = $_SESSION['adm_username'];
    mysqli_query($koneksi, "INSERT INTO tb_log VALUES ('$timestamp', '$aksi', '$userlog', '$deskripsi')");

    // -- End Create Log --
    
    ob_start(); 
    header('location:sispp_data.php?message=edit_success');
    exit();
}
?>