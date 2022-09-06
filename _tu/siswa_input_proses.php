<?php 
session_start();
if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Admin'){
    session_destroy();	
    $login_redirect_url = "../index.php";
    echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
} else {
    include "../dbcon/config.php";
    $nis = $_POST['nis']; 
    $nama= $_POST['nama']; 
    $jk = $_POST['jk']; 
    $kelas = $_POST['kelas']; 
    $keterangan = $_POST['keterangan']; 

    //Cek Data Siswa
    $cek_nis = "SELECT * FROM tb_siswa WHERE id_nis='$nis'"; 
    $qry = mysqli_query($koneksi, $cek_nis); 

    if (mysqli_num_rows($qry) == 1){
        header('location:siswa_input.php?message=nis_used');
    } else {
        if ($_POST['nominal_spp_auto'] != "manual"){
            //echo "Tidak ada nominal";
            $nomi = $_POST['nominal_spp_auto']; 
            mysqli_query($koneksi,"INSERT INTO tb_siswa VALUES ('$nis','$nama', '$jk', '$kelas', '$nomi', '$keterangan')");
            header('location:siswa_input.php?message=add_success');
        } elseif ($_POST['nominal_spp_auto'] == "manual"){
            if($_POST['nominal_spp'] == null){
                $nomi = "0"; 
            } else {
                $nomi = $_POST['nominal_spp'];
            }
            $simpan = str_replace(".", "", $nomi);
               
            
           


            $sql = mysqli_query($koneksi,"INSERT INTO tb_siswa VALUES ('$nis','$nama', '$jk', '$kelas', '$simpan', '$keterangan')");
            
            if($sql){

                 // Create Log Activity  
                $deskripsi = "Menambahkan Siswa, ID=".$nis; 
                $timestamp = date('d-m-Y H:i:s'); 
                $aksi = "Insert"; 
                $userlog = $_SESSION['adm_username'];
                mysqli_query($koneksi, "INSERT INTO tb_log VALUES ('$timestamp', '$aksi', '$userlog', '$deskripsi')");
                
                // -- End Create Log --

                ob_start();
                header('location:siswa_input.php?message=add_success');
                exit();
            }else{
                ob_start(); 
                header('location:siswa_input.php?message=add_failed');
                exit();
            }
            
        }
    }
}
?>