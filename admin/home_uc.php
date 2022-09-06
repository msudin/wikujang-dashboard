<?php
    include '../utils/auth_case.php';
    date_default_timezone_set('Asia/Jakarta');


    // FUNCTIONS
    function dateToday() {
        return date("Y-m-d");
    }

    function thisYear() {
        return date('Y'); 
    }

    function validateHome() {
        session_start();
    
        if(!empty($_SESSION['typeLogin']) && $_SESSION['typeLogin'] == "0"){
            session_destroy();	
            $login_redirect_url = "../index.php";
            echo "<script>alert('Guest akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
            return false; 
        } else {
            if (validateAdminSession() === false) {
                return false; 
            } else {
               return true;                
            }
        }
    }
    
    function getDataGrafik() {
        include '../dbcon/config.php';
        date_default_timezone_set('Asia/Jakarta');
    
        // VARIABLES
        $date_today = dateToday();
        $thisYear = thisYear(); 
    
        //Cek Bulan Janurari 
        $set_jnr = $thisYear."-01"; 
        $qry1 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_jnr'"); 
        $jan = mysqli_num_rows($qry1);  
      
        //Cek Bulan Februari
        $set_feb = $thisYear."-02"; 
        $qry2 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_feb'"); 
        $feb = mysqli_num_rows($qry2);  
      
        //Cek Bulan Maret
        $set_mrt = $thisYear."-03"; 
        $qry3 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_mrt'"); 
        $mart = mysqli_num_rows($qry3);
        
        //Cek Bulan APRIL
        $set_apr = $thisYear."-04"; 
        $qry4 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_apr'"); 
        $apr = mysqli_num_rows($qry4);  
        
        //Cek Bulan Mei
        $set_mei = $thisYear."-05"; 
        $qry5 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_mei'"); 
        $mei = mysqli_num_rows($qry5);  
        
        //Cek Bulan Juni
        $set_jun = $thisYear."-06"; 
        $qry6 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_jun'"); 
        $jun = mysqli_num_rows($qry6);  
        
        //Cek Bulan Juli
        $set_jul = $thisYear."-07"; 
        $qry7 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_jul'"); 
        $jul = mysqli_num_rows($qry7);  
        
        //Cek Bulan Agustus
        $set_agus= $thisYear."-08"; 
        $qry8 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_agus'"); 
        $agus = mysqli_num_rows($qry8);  
        
        //Cek Bulan September
        $set_sep= $thisYear."-09"; 
        $qry9 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_sep'"); 
        $sep = mysqli_num_rows($qry9);
        
        //Cek Bulan Oktober
        $set_okt= $thisYear."-10"; 
        $qry10 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_okt'"); 
        $okt = mysqli_num_rows($qry10);  
        
        //Cek Bulan November
        $set_nov= $thisYear."-11"; 
        $qry11 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_nov'"); 
        $nov = mysqli_num_rows($qry11);  
        
        //Cek Bulan Desember
        $set_des= $thisYear."-12"; 
        $qry12 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_des'"); 
        $des = mysqli_num_rows($qry12);  
      
        $total = array("$jan", "$feb", "$mart", "$apr", "$mei", "$jun", "$jul",
                      "$agus", "$sep","$okt","$nov", "$des");
    
        return $total;
    }

    function getTotalThisDayTrans(){
        include '../dbcon/config.php';
        date_default_timezone_set('Asia/Jakarta');

        $today = dateToday();
        $sum_bayar_today= mysqli_query($koneksi, "SELECT SUM(nominal_bayar) FROM tb_pembayaran WHERE tgl_bayar LIKE '%$today%' ");
        $data_nilai = mysqli_fetch_array($sum_bayar_today); 
        $jumlah_nilai = $data_nilai[0]; 
        return $jumlah_nilai;
    }

    function getTotalTransToday(){
        include '../dbcon/config.php';
        date_default_timezone_set('Asia/Jakarta');

        $today = dateToday();
        $sql_trans_count= mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE tgl_bayar LIKE '%$today%' ");
        $transcount = mysqli_num_rows($sql_trans_count);
        return $transcount;
    }
?>