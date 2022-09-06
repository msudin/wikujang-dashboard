<?php

if (isset($_GET['uc_type'])) {
    $uc_type = $_GET['uc_type'];
    repos($uc_type);
} elseif (isset($_POST['uc_type'])) {
    $uc_type = $_POST['uc_type'];
    repos($uc_type);
}

function repos($uc_type) {
    include '../dbcon/config.php';
    include '../utils/err_case.php';

}

// FUNCTIONS 
function validateSession(){
    include '../utils/auth_case.php';

    validateAdminSession();
}

function getSiswaSearch($nis) {
    include '../dbcon/config.php';

    $transcari_redirect_url = "transaksi_cari.php";
    if (!empty($nis)) {
        $sql = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE id_nis='$nis' "); 
        $ds = mysqli_fetch_array($sql); 
        if (mysqli_num_rows($sql) == 0){
          echo "<script>alert('NIS tidak ditemukan !'); window.location = '$transcari_redirect_url'</script>";
        } else {
            return array(TRUE, $ds);
        }
    } else {
        echo "<script>alert('Silahkan masukkan NIS !'); window.location = '$transcari_redirect_url'</script>";
    }
}

function generateTransId(){
    include '../dbcon/config.php';

    $date_today = date("Y-m-d"); 
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE tgl_bayar LIKE '%$date_today%'");
    if (mysqli_num_rows($sql) != null){ 
      $date_trans = date("Ymd");
      $sql_trans = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE tgl_bayar LIKE '%$date_today%' ORDER BY id_bayar DESC LIMIT 1");
      $tr = mysqli_fetch_array($sql_trans);
      $gettrkode = substr($tr['id_bayar'], 0, 11); 
      $getDate = substr($tr['id_bayar'],8,5); 
      $trkodelast = $getDate + 1 ; 

      //--- Set Tr Kode ---//
      if($getDate < 9){
        $datefinal = $gettrkode.$trkodelast;
      }elseif ($trkodelast > 999){
        $gettrkode4 = substr($tr['id_bayar'], 0, 8); 
        $datefinal = $gettrkode4.$trkodelast;
      }elseif ($trkodelast > 99){
          $gettrkode3 = substr($tr['id_bayar'], 0, 9); 
          $datefinal = $gettrkode3.$trkodelast;
      } elseif ($trkodelast > 9 ) {
        $gettrkode2 = substr($tr['id_bayar'], 0, 10); 
        $datefinal = $gettrkode2.$trkodelast;
      } 

      return $datefinal;
    } else {
        $date_null = date("Ymd"); 
        $id_tr = $date_null."0001"; 
        return $id_tr;
    }
}

function getListTrans($nis) {
    include '../dbcon/config.php';

    //$data_pembayaran = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE nis_bayar='$id_nis' AND kls_bayar='$kls_nis' ORDER BY id_bayar Desc"); 
    $data_pembayaran = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE nis_bayar='$nis' ORDER BY bulan_bayar Desc");
    return $data_pembayaran; 
}

?>