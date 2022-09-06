<?php
session_start();
if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Admin'){
    session_destroy();	
    $login_redirect_url = "../index.php";
    echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
}

    include "../dbcon/config.php";
    $id_nis = $_POST['id_nis']; 
    $id_tr = $_POST['id_trans']; 
    $tgl_trans = $_POST['tgl_trans']; 
    $nominal = $_POST['nominal_spp']; 
    $kelas = $_POST['kelas_siswa']; 
    $adm = $_POST['admin'];
    $bulan = $_POST['bulan']; 
    $tahun = $_POST['tahun']; 
    $bulan_tahun = $tahun."-".$bulan; 

  
    
    $sql_checked = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE nis_bayar='$id_nis' AND bulan_bayar='$bulan_tahun' ");
    if(mysqli_num_rows($sql_checked) >= 1){
        ob_start();
        header('location:transaksi_data.php?nis='.$id_nis.'&message=already_exist');
        exit();
    } else {
        $qry = "INSERT INTO tb_pembayaran VALUES('$id_tr','$id_nis','$kelas','$nominal','$bulan_tahun', '$adm', '$tgl_trans')";  
        $sql = mysqli_query($koneksi, $qry); 

        // Create Log Activity  
        $deskripsi = "Menambahkan Transaksi Pembayaran, ID=".$id_tr; 
        $timestamp = date('d-m-Y H:i:s'); 
        $aksi = "Insert"; 
        $userlog = $_SESSION['adm_username'];
        mysqli_query($koneksi, "INSERT INTO tb_log VALUES ('$timestamp', '$aksi', '$userlog', '$deskripsi')");

        // -- End Create Log --
   
        ob_start();
        header('location:transaksi_data.php?nis='.$id_nis);
        exit();
    }




    

    
    
    
?>