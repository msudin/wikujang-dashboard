<?php

// GET POST METHOD 
if (isset($_GET['uc_type'])){
    $uc_type = $_GET['uc_type'];
    repos($uc_type);
} elseif (isset($_POST['uc_type'])){
    $uc_type = $_POST['uc_type'];
    repos($uc_type);
}

function validation() {
    session_start();
    if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Admin'){
        session_destroy();
        $login_redirect_url = "../index.php";
        echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
    }
}


function repos($uc_type) {
    include "../dbcon/config.php";
    include "../utils/err_case.php";

    validation();
    if (!empty($uc_type)){
        if ($uc_type == "insert"){
            $kelas_name = $_POST['kelas_name'];
            $result = mysqli_query($koneksi,"INSERT INTO tb_kelas (id_kelas,nama_kelas) VALUES (NULL,'$kelas_name')");
    
            if ($result == 1){
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
            } else {
                ucHandler("{$uc_type} => Add Kelas Failed");
            }
        } elseif ($uc_type == "update"){
            $modal_id=$_POST['modal_id'];
            $modal_name = $_POST['modal_name'];
            $result = mysqli_query($koneksi,"UPDATE tb_kelas SET nama_kelas= '$modal_name' WHERE id_kelas='$modal_id'");
    
            if ($result == 1){
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
            } else {
                ucHandler("{$uc_type} => Update Kelas Failed");
            }
        } else if ($uc_type == "delete"){
            $modal_id=$_GET['modal_id'];
            $select = mysqli_query($koneksi, "SELECT * FROM tb_kelas WHERE id_kelas='$modal_id'"); 
            $kls = mysqli_fetch_array($select);
            $result = $modal = mysqli_query($koneksi,"Delete FROM tb_kelas WHERE id_kelas='$modal_id'");
    
            if ($result == 1) {
                // Create Log Activity  
                $namakelas = $kls['nama_kelas'];
                $deskripsi = "Hapus Kelas, ID=".$modal_id." Value=".$namakelas; 
                $timestamp = date('d-m-Y H:i:s'); 
                $aksi = "Delete"; 
                $userlog = $_SESSION['adm_username'];
                mysqli_query($koneksi, "INSERT INTO tb_log VALUES ('$timestamp', '$aksi', '$userlog', '$deskripsi')");
                // -- End Create Log --
    
                ob_start(); 
                header('location:kelas_data.php?message=delete_success');
                exit();
            } else {
                ucHandler("{$uc_type} => Delete Kelas Failed");
            }
        }
    } else {
        ucHandler($uc_type);
    }
}


// FUNCTIONS
function getDataKelas() {
    include "../dbcon/config.php";

    $dataList = mysqli_query($koneksi, "SELECT * FROM tb_kelas"); 
    return $dataList;
}

function getKelasDetail($id_kelas) {
    include "../dbcon/config.php";

    $modal=mysqli_query($koneksi, "SELECT * FROM tb_kelas WHERE id_kelas='$id_kelas'");
    $r=mysqli_fetch_array($modal);
    return $r;
}

?>