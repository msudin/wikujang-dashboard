<?php
include '../dbcon/config.php';
session_start();
if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Admin'){
    session_destroy();	
    $login_redirect_url = "../index.php";
    echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
}

if(isset($_POST['simpan_edit'])){
   $nis = $_POST['nis']; 
   $nama = $_POST['nama']; 
   $jk_siswa = $_POST['jk'];
   $kelas = $_POST['kelas']; 

  $sql = mysqli_query($koneksi,"UPDATE tb_siswa SET nama_siswa='$nama', jk_siswa='$jk_siswa', kls_siswa='$kelas' WHERE id_nis='$nis'");
 
  // Create Log Activity  
  $deskripsi = "Merubah Siswa, ID=".$nis; 
  $timestamp = date('d-m-Y H:i:s'); 
  $aksi = "Update"; 
  $userlog = $_SESSION['adm_username'];
  mysqli_query($koneksi, "INSERT INTO tb_log VALUES ('$timestamp', '$aksi', '$userlog', '$deskripsi')");

  // -- End Create Log --


  ob_start(); 
  header('location:siswa_data.php?message=edit_success');
  exit();
}

?>