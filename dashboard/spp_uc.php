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

    validateSession();
    if ($uc_type == "insert") {
        $nilai_spp = trim($_POST['nominal_spp']);
        $simpan = str_replace(".", "", $nilai_spp);
        if(is_numeric($simpan) == TRUE){
           $result =  mysqli_query($koneksi,"INSERT INTO tb_spp VALUES (NULL,'$simpan')");

           if ($result) {
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
        } else {
            ob_start();
            header('location:spp_default.php?message=add_failed');
            exit();
        }
    } elseif ($uc_type == "delete") {
        $modal_id=$_GET['modal_id'];
        $select = mysqli_query($koneksi, "SELECT * FROM tb_spp WHERE id_spp='$modal_id'"); 
       
        $slt = mysqli_fetch_array($select); 
        $id_slt = $slt['nominal_spp'];
        $result = mysqli_query($koneksi,"Delete FROM tb_spp WHERE id_spp='$modal_id'");

        if ($result) {
            // Create Log Activity  
            $deskripsi = "Menghapus SPP, ID=".$modal_id."Value=".$id_slt; 
            $timestamp = date('d-m-Y H:i:s'); 
            $aksi = "Delete"; 
            $userlog = $_SESSION['adm_username'];
            mysqli_query($koneksi, "INSERT INTO tb_log VALUES ('$timestamp', '$aksi', '$userlog', '$deskripsi')");
            // -- End Create Log --

            ob_start();
            header('location:spp_default.php?message=delete_success');
            exit();
        } else {
            ucHandler("Failed delete data");   
        }
    }  
}

// FUNCTIONS 
function validateSession() {
    include '../utils/auth_case.php'; 

    validateAdminSession();
}

function getDataSPP() {
    include '../dbcon/config.php';

    $data = mysqli_query($koneksi, "SELECT * FROM tb_spp"); 
    return $data;
}

?>