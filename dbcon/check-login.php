<?php

include 'config.php';

$akses = array(
	'1' => 'Admin',
	'2' => 'Tata Usaha',
	'3' => 'Kepala Sekolah',
	'4' => 'Guest'
);

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = base64_encode(mysqli_real_escape_string($koneksi, $_POST['password']));

if(isset($_POST['submitLogin'])){
  $typeLogin = "1";
} else if(isset($_POST['guestLogin'])){
  $typeLogin = "0";
}

// typeLogin :
// 1 = login (to access admin etc)
// 0 = guest (only for student)

if($typeLogin == "0"){
  session_start();
  $_SESSION['adm_username'] = $akses[4];;
  $_SESSION['adm_level'] =  $akses[4];
  $_SESSION['typeLogin'] = "0"; 
  header('location:../admin/transaksi_cari_peruser.php');
  exit();
} else {
  $sql ="select * from admin where adm_username='$username' and adm_pass='$password'";
  $qry = mysqli_query($koneksi, $sql);
  $row = mysqli_fetch_array($qry);
  $get_akses = $row['adm_level']; 
  if (mysqli_num_rows($qry) == 1) {
    session_start();
    $_SESSION['user_id'] = $row['id_admin'];
    $_SESSION['adm_username'] = $row['adm_fullname'];
    $_SESSION['adm_level'] = $akses[$get_akses];
    $_SESSION['typeLogin'] = "1";  
    if($get_akses =='1'){
      //echo "<script>alert('Anda Log In. Sebagai : $level ');</script>";
      ob_start(); 
      header('location:../admin/index.php');
      exit();
      //echo "<meta http-equiv='refresh' content='0; url=../admin/index.php'>";
    }elseif($get_akses =='2'){
      //echo "<script>alert('Anda Log In. Sebagai : $level ');</script>";
      //echo "<meta http-equiv='refresh' content='0; url=../_tu/index.php'>";
      //header('location:../_tu/index.php');
      ob_start(); 
      echo "<script>alert('Mohon maaf, Akses Login TU masih dalam proses pengembangan.');</script>";
      echo "<meta http-equiv='refresh' content='0; url=../logout.php'>";
      //header('location:../_tu/index.php');
      exit();
    }elseif($get_akses =='3'){
      //echo "<script>alert('Anda Log In. Sebagai : $level ');</script>";
      //echo "<meta http-equiv='refresh' content='0; url=../_tu/index.php'>";
      ob_start(); 
      echo "<script>alert('Mohon maaf, Akses Login KS masih dalam proses pengembangan.');</script>";
      echo "<meta http-equiv='refresh' content='0; url=../logout.php'>";
      // header('location:../_ks/index.php');
      exit();
      //header('location:../_tu/index.php');
    }
  }else { 
    ob_start(); 
      header('location:../index.php?message=error');
      exit();
    }
}
?>